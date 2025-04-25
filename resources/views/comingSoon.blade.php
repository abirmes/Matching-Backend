<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Pacifico&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fdf2f8;
            color: #4b5563;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .bubble {
            position: absolute;
            background-color: rgba(244, 114, 182, 0.1);
            border-radius: 50%;
            animation: float 8s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }
        
        .container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            z-index: 10;
        }
        
        .logo {
            margin-bottom: 2rem;
        }
        
        .logo img {
            width: 120px;
            height: auto;
        }
        
        h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3.5rem;
            color: #db2777;
            margin-bottom: 1rem;
        }
        
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .countdown {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .countdown-number {
            font-size: 2rem;
            font-weight: 700;
            background-color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(219, 39, 119, 0.1);
            color: #db2777;
            margin-bottom: 0.5rem;
        }
        
        .countdown-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .newsletter {
            background-color: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .newsletter h2 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #db2777;
        }
        
        .newsletter-form {
            display: flex;
            gap: 0.5rem;
        }
        
        .newsletter-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-family: 'Nunito', sans-serif;
        }
        
        .newsletter-button {
            background-color: #db2777;
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .newsletter-button:hover {
            background-color: #be185d;
        }
        
        .social-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #db2777;
            text-decoration: none;
            transition: transform 0.3s, background-color 0.3s;
        }
        
        .social-link:hover {
            transform: translateY(-3px);
            background-color: #db2777;
            color: white;
        }
        
        @media (max-width: 640px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .countdown {
                gap: 1rem;
            }
            
            .countdown-number {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-button {
                width: 100%;
            }
        }

        .cat-img {
            margin: 1.5rem 0;
            animation: bounce 2s infinite ease-in-out;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <!-- Decorative bubbles -->
    <div class="bubble" style="width: 100px; height: 100px; top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="bubble" style="width: 150px; height: 150px; top: 40%; left: 80%; animation-delay: 1s;"></div>
    <div class="bubble" style="width: 80px; height: 80px; top: 80%; left: 20%; animation-delay: 2s;"></div>
    <div class="bubble" style="width: 60px; height: 60px; top: 20%; left: 60%; animation-delay: 3s;"></div>
    <div class="bubble" style="width: 120px; height: 120px; top: 70%; left: 70%; animation-delay: 4s;"></div>

    <div class="container">
        <div class="logo">
            <img src="/api/placeholder/120/120" alt="Logo placeholder">
        </div>
        
        <h1>Coming Soon!</h1>
        
        <p>We're working on something amazing and can't wait to share it with you. Our website is launching soon!</p>
        
        <div class="cat-img">
            <img src="/api/placeholder/200/160" alt="Cute cat illustration">
        </div>
        
        <div class="countdown">
            <div class="countdown-item">
                <div class="countdown-number" id="days">14</div>
                <div class="countdown-label">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="hours">23</div>
                <div class="countdown-label">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="minutes">59</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="seconds">42</div>
                <div class="countdown-label">Seconds</div>
            </div>
        </div>
        
        <div class="newsletter">
            <h2>Get notified when we launch!</h2>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
                <button type="submit" class="newsletter-button">Notify Me</button>
            </form>
        </div>
        
        <div class="social-links">
            <a href="#" class="social-link">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            <a href="#" class="social-link">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
            </a>
            <a href="#" class="social-link">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                </svg>
            </a>
        </div>
    </div>

    <script>
        // Set the launch date (adjust as needed)
        const launchDate = new Date();
        launchDate.setDate(launchDate.getDate() + 14); // 14 days from now
        
        function updateCountdown() {
            const now = new Date();
            const difference = launchDate - now;
            
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);
            
            document.getElementById('days').innerText = days;
            document.getElementById('hours').innerText = hours;
            document.getElementById('minutes').innerText = minutes;
            document.getElementById('seconds').innerText = seconds;
        }
        
        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
        
        // Prevent form submission (for demo purposes)
        document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for subscribing! We\'ll notify you when we launch.');
            this.reset();
        });
    </script>
</body>
</html>