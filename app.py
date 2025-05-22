from flask import Flask, request, jsonify
from flask_cors import CORS
import logging
from deep_translator import GoogleTranslator

app = Flask(__name__)
CORS(app)

# Enable logging
logging.basicConfig(filename='chatbot.log', level=logging.INFO)

# Intent-based responses
responses = {
    "greeting": "👋 Hello! Welcome to Nival Travel and Tours. How can I help you today?",
    "tours": "🌍 We offer unforgettable tours including Zanzibar, Serengeti, and cultural safaris.",
    "hotel": "🏨 We offer hotel booking services with optional packages including meals and transport.",
    "visa": "🛂 Need a visa? We help with processing, paperwork, and embassy appointments.",
    "appointment": "📅 We book appointments with embassies, agents, and more.",
    "car": "🚘 We rent cars for city, safari, and long-distance travel. Chauffeur available!",
    "offer": "🎁 Current offers include discounts on Zanzibar trips, hotel upgrades, and more!",
    "payment": "💳 You can pay via mobile money, bank transfer, or credit card.",
    "hours": "⏰ Our office is open Mon–Sat from 8:00 AM to 6:00 PM.",
    "location": "📍 We are located in Dar es Salaam, Tanzania.",
    "contact": "📞 Contact us at +255 123 456 789 or info@nivaltravel.co.tz.",
    "default": "🤖 I'm Nival's travel assistant. Ask me about our tours, visa help, hotels, and more!",
    "unknown": "❓ Sorry, I didn't understand that.",
    "booking": "📩 Go to your required service and click the booking button to book.",
    "airport": "🛬 We offer airport pickups and drop-offs. Let us know your arrival time and flight number.",
    "ticketing": "🎫 We help with flight ticket booking — both domestic and international. Just tell us your destination!",
}

# Keywords mapped to intents
keywords_map = {
    "greeting": ["hello", "hi", "hey", "sasa", "salamu", "habari"],
    "tours": ["tour", "utalii", "safari", "zanzibar", "arusha", "trip"],
    "hotel": ["hotel", "hoteli", "room", "booking"],
    "visa": ["visa", "travel document", "entry permit"],
    "appointment": ["appointment", "miadi", "schedule"],
    "car": ["car", "gari", "rental", "chauffeur"],
    "offer": ["offer", "discount", "promotion", "deal"],
    "payment": ["payment", "malipo", "pay", "lipa"],
    "hours": ["hours", "time", "saa", "opening"],
    "location": ["location", "mahali", "address", "office", "wapi"],
    "contact": ["contact", "call", "email", "wasiliana", "namba"],
    "booking": ["how to book", "how can i book", "how i can book", "booking process", "nifanyeje kuhifadhi"],
    "airport": ["airport", "pickup", "drop-off", "arrival", "departure", "airport transfer"],
    "ticketing": ["ticketing", "flight", "book ticket", "plane ticket", "tiketi", "tiketi ya ndege"],
}

# Specific tour offers
specific_offers = {
    "zanzibar": "🏝️ Zanzibar tour: 3 nights + Stone Town + Nungwi beach for only $499!",
    "arusha": "🌄 Arusha getaway: 2-night hotel + Mount Meru hike from $299!",
    "safari": "🦁 Serengeti Safari: 3 days full board, $899 all inclusive!",
}

# Casual expressions
casual_responses = {
    "how are you": "😊 I'm great, ready to help!",
    "are you okay": "😄 Yes, I'm good. What can I do for you?",
    "what's up": "👋 Just helping people plan great trips!",
    "how do you do": "🤖 I'm doing well, thanks!",
}

# Common thanks/ok
thanks_words = ["thanks", "thank you", "thank u", "asante", "shukrani", "thx"]
okay_words = ["okay", "ok", "sawa", "poa"]
owner_questions = ["owner", "boss", "director", "privacy", "personal", "admin", "malipo binafsi"]

# Simulated flight data
def get_flight_info():
    return {"destination": "Zanzibar", "price": "$199", "seats": "5 seats left"}

# Suggest possible intents if user input is unknown
def suggest_intent(message):
    suggestions = []
    for intent, keywords in keywords_map.items():
        for word in keywords:
            if word in message:
                suggestions.append(intent)
    return "Did you mean: " + ", ".join(set(suggestions)) + "?" if suggestions else ""

# Handle casual expressions
def handle_casual(message):
    for phrase, reply in casual_responses.items():
        if phrase in message:
            return reply
    return None

# Root route
@app.route('/')
def index():
    return "🧭 Nival Travel Chatbot Running!"

# Chat route
@app.route('/chat', methods=['POST'])
def chat():
    data = request.json
    user_msg = data.get('message', '').lower().strip()

    logging.info(f"User said: {user_msg}")

    # Translate message to English for uniform keyword matching
    try:
        translated_msg = GoogleTranslator(source='auto', target='en').translate(user_msg).lower()
    except Exception as e:
        logging.error(f"Translation failed: {e}")
        translated_msg = user_msg  # fallback

    # Check casual expressions first
    casual = handle_casual(translated_msg)
    if casual:
        return jsonify({"response": casual})

    # Booking first
    if any(phrase in translated_msg for phrase in keywords_map["booking"]) or any(phrase in user_msg for phrase in keywords_map["booking"]):
        return jsonify({"response": responses["booking"]})

    # Thanks
    if any(word in translated_msg for word in thanks_words) or any(word in user_msg for word in thanks_words):
        return jsonify({"response": "🙏 Thanks!"})

    # Okay
    if any(word in translated_msg for word in okay_words) or any(word in user_msg for word in okay_words):
        return jsonify({"response": "👌 Okay!"})

    # Specific offers
    for key in specific_offers:
        if key in translated_msg:
            return jsonify({"response": specific_offers[key]})

    # Owner-related
    if any(word in translated_msg for word in owner_questions) or any(word in user_msg for word in owner_questions):
        return jsonify({
            "response": "🔐 For privacy or direct issues, contact the owner:\n📞 +255 123 456 789\n📧 info@nivaltravel.co.tz"
        })

    # Pricing
    if "price" in translated_msg or "bei" in translated_msg:
        for svc in ["tour", "visa", "hotel", "car", "appointment"]:
            if svc in translated_msg:
                return jsonify({
                    "response": "💬 Please contact the owner for pricing info:\n📞 +255 123 456 789\n📧 info@nivaltravel.co.tz"
                })

    # Flight info
    if "flight" in translated_msg or "tiketi" in translated_msg:
        flight = get_flight_info()
        return jsonify({
            "response": f"✈️ Flight to {flight['destination']} available for {flight['price']} ({flight['seats']})."
        })

    # General intent matching
    found = []
    for intent, keywords in keywords_map.items():
        if any(kw in translated_msg for kw in keywords):
            found.append(responses[intent])

    if found:
        return jsonify({"response": "\n\n".join(set(found))})

    # Unknown fallback
    return jsonify({"response": f"{responses['unknown']} {suggest_intent(translated_msg)}"})

# Run the app
if __name__ == '__main__':
    app.run(debug=True)
