<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
        /* --- CSS Variables --- */
        :root {
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
        }

        /* --- Base Reset --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--theme-color1);
            background: radial-gradient(circle at center, #0f4c5c 0%, var(--theme-color1) 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* --- Main Container --- */
        .error-container {
            position: relative;
            width: 100%;
            max-width: 700px;
            padding: 40px 20px;
            text-align: center;
            z-index: 10;
        }

        /* --- Crash Scene --- */
        .crash-scene {
            position: relative;
            width: 100%;
            height: 180px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        /* --- Truck Crash Wrapper --- */
        .truck-crash {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 150px;
            height: 70px;
            animation: crashSequence 2s ease-in-out infinite;
        }

        /* Trailer */
        .trailer {
            position: absolute;
            left: 0;
            top: 10px;
            width: 100px;
            height: 45px;
            background: var(--light-gray);
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform-origin: bottom left;
            z-index: 2;
        }

        .trailer::before {
            content: '📦';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 22px;
        }

        /* Falling Box */
        .box-falling {
            position: absolute;
            top: -30px;
            left: 30px;
            font-size: 24px;
            opacity: 0;
            animation: boxFall 2s ease-in-out infinite;
        }

        @keyframes boxFall {

            0%,
            60% {
                opacity: 0;
                transform: translateY(0) rotate(0deg);
            }

            70% {
                opacity: 1;
            }

            85% {
                transform: translateY(60px) rotate(45deg);
            }

            100% {
                opacity: 0;
                transform: translateY(80px) rotate(90deg);
            }
        }

        /* Cabin */
        .cabin {
            position: absolute;
            right: 0;
            top: 15px;
            width: 45px;
            height: 40px;
            background: var(--theme-color2);
            border-radius: 0 6px 6px 0;
            z-index: 3;
            transform-origin: bottom right;
        }

        .window {
            position: absolute;
            right: 4px;
            top: 4px;
            width: 20px;
            height: 16px;
            background: #1a1a1a;
            border-radius: 0 4px 4px 0;
        }

        .light {
            position: absolute;
            right: -4px;
            top: 28px;
            width: 6px;
            height: 10px;
            background: #ff4444;
            border-radius: 0 3px 3px 0;
            box-shadow: 0 0 10px #ff4444;
        }

        /* Impact Star */
        .impact-star {
            position: absolute;
            top: -10px;
            right: 20px;
            font-size: 35px;
            opacity: 0;
            animation: starBurst 2s ease-in-out infinite;
            z-index: 10;
        }

        @keyframes starBurst {

            0%,
            55% {
                opacity: 0;
                transform: scale(0);
            }

            60% {
                opacity: 1;
                transform: scale(1.2);
            }

            70% {
                opacity: 1;
                transform: scale(1);
            }

            80% {
                opacity: 0;
                transform: scale(1.5);
            }

            100% {
                opacity: 0;
                transform: scale(0);
            }
        }

        /* Wheels */
        .wheel {
            position: absolute;
            bottom: 0;
            width: 24px;
            height: 24px;
            background: var(--dark-gray);
            border-radius: 50%;
            border: 3px solid #555;
        }

        .wheel.front {
            right: 8px;
        }

        .wheel.back {
            left: 12px;
        }

        .wheel::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: #777;
            border-radius: 50%;
        }

        /* --- Barrier --- */
        .barrier {
            position: absolute;
            right: 5%;
            bottom: 20px;
            width: 60px;
            height: 50px;
        }

        .barrier-sign {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 35px;
            background: #ffcc00;
            border: 3px solid var(--dark-gray);
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: 900;
            color: var(--dark-gray);
            transform: rotate(-5deg);
        }

        .barrier-post {
            position: absolute;
            bottom: 0;
            width: 8px;
            height: 40px;
            background: var(--dark-gray);
            border-radius: 2px;
        }

        .barrier-post.left {
            left: 10px;
        }

        .barrier-post.right {
            right: 10px;
        }

        /* --- Debris --- */
        .debris {
            position: absolute;
            font-size: 20px;
            opacity: 0;
        }

        .debris-1 {
            bottom: 30px;
            right: 8%;
            animation: debrisFly1 2s ease-in-out infinite;
        }

        .debris-2 {
            bottom: 50px;
            right: 12%;
            animation: debrisFly2 2s ease-in-out infinite;
        }

        .debris-3 {
            bottom: 25px;
            right: 15%;
            animation: debrisFly3 2s ease-in-out infinite;
        }

        @keyframes debrisFly1 {

            0%,
            60% {
                opacity: 0;
                transform: translate(0, 0);
            }

            70% {
                opacity: 1;
            }

            90% {
                opacity: 0;
                transform: translate(-80px, -60px) rotate(180deg);
            }

            100% {
                opacity: 0;
                transform: translate(-100px, -80px) rotate(360deg);
            }
        }

        @keyframes debrisFly2 {

            0%,
            65% {
                opacity: 0;
                transform: translate(0, 0);
            }

            75% {
                opacity: 1;
            }

            95% {
                opacity: 0;
                transform: translate(-60px, -80px) rotate(-180deg);
            }

            100% {
                opacity: 0;
                transform: translate(-80px, -100px) rotate(-360deg);
            }
        }

        @keyframes debrisFly3 {

            0%,
            70% {
                opacity: 0;
                transform: translate(0, 0);
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translate(-40px, -50px) rotate(90deg);
            }
        }

        /* --- Smoke Effect --- */
        .smoke {
            position: absolute;
            bottom: 20px;
            right: 10%;
            width: 30px;
            height: 30px;
            background: rgba(150, 150, 150, 0.6);
            border-radius: 50%;
            filter: blur(8px);
            opacity: 0;
        }

        .smoke-1 {
            animation: smokeRise 2s ease-out infinite;
        }

        .smoke-2 {
            animation: smokeRise 2s ease-out 0.3s infinite;
        }

        .smoke-3 {
            animation: smokeRise 2s ease-out 0.6s infinite;
        }

        @keyframes smokeRise {
            0% {
                opacity: 0;
                transform: scale(0.5) translateY(0);
            }

            60% {
                opacity: 0;
            }

            70% {
                opacity: 0.7;
            }

            100% {
                opacity: 0;
                transform: scale(2) translateY(-60px);
            }
        }

        /* --- Main Crash Animation --- */
        @keyframes crashSequence {
            0% {
                left: -100%;
                transform: rotate(0deg);
            }

            35% {
                left: 30%;
                transform: rotate(0deg);
                animation-timing-function: ease-out;
            }

            45% {
                left: 48%;
                transform: rotate(0deg);
            }

            50% {
                left: 45%;
                transform: rotate(-15deg);
            }

            60% {
                left: 42%;
                transform: rotate(-25deg);
            }

            100% {
                left: 42%;
                transform: rotate(-25deg);
            }
        }

        /* --- Error Text --- */
        .error-text {
            margin-bottom: 40px;
        }

        .error-text h1 {
            font-size: 120px;
            font-weight: 900;
            color: var(--theme-color2);
            line-height: 1;
            text-shadow: 4px 4px 0 rgba(0, 0, 0, 0.3);
            animation: textBounce 0.8s ease-out;
        }

        .error-text h2 {
            font-size: 34px;
            margin: 10px 0 20px;
            color: var(--white);
            animation: textSlideUp 0.8s ease-out 0.2s both;
        }

        .error-text p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.8);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
            animation: textSlideUp 0.8s ease-out 0.4s both;
        }

        @keyframes textBounce {
            0% {
                transform: scale(2);
                opacity: 0;
            }

            50% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes textSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Buttons --- */
        .error-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            animation: textSlideUp 0.8s ease-out 0.6s both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 40px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--theme-color2);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(255, 109, 69, 0.4);
        }

        .btn-primary:hover {
            background: var(--theme-color3);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(255, 109, 69, 0.5);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .btn-outline:hover {
            border-color: var(--white);
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-4px);
        }

        /* --- Floating Elements --- */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }

        .elem {
            position: absolute;
            font-size: 35px;
            opacity: 0.15;
            animation: floatAround 6s ease-in-out infinite;
        }

        .e1 {
            top: 5%;
            left: 5%;
            animation-delay: 0s;
        }

        .e2 {
            top: 15%;
            right: 10%;
            animation-delay: 1s;
        }

        .e3 {
            bottom: 20%;
            left: 8%;
            animation-delay: 2s;
        }

        .e4 {
            bottom: 10%;
            right: 5%;
            animation-delay: 3s;
        }

        @keyframes floatAround {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-15px) rotate(5deg);
            }

            50% {
                transform: translateY(-5px) rotate(-5deg);
            }

            75% {
                transform: translateY(-20px) rotate(3deg);
            }
        }

        /* --- Responsive --- */
        @media (max-width: 600px) {
            .error-text h1 {
                font-size: 80px;
            }

            .error-text h2 {
                font-size: 26px;
            }

            .error-text p {
                font-size: 16px;
            }

            .btn {
                width: 100%;
            }

            .truck-crash {
                transform: scale(0.8);
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <!-- Crash Animation -->
        <div class="crash-scene">
            <div class="truck-crash">
                <div class="trailer">
                    <div class="box box-falling">📦</div>
                </div>
                <div class="cabin">
                    <div class="window"></div>
                    <div class="light"></div>
                </div>
                <div class="wheel front"></div>
                <div class="wheel back"></div>
                <div class="impact-star">💥</div>
            </div>

            <div class="barrier">
                <div class="barrier-sign">STOP</div>
                <div class="barrier-post left"></div>
                <div class="barrier-post right"></div>
            </div>

            <div class="debris pieces">
                <div class="debris debris-1">🔧</div>
                <div class="debris debris-2">⚙️</div>
                <div class="debris debris-3">🔩</div>
            </div>

            <div class=" smoke-effect">
                <div class="smoke smoke-1"></div>
                <div class="smoke smoke-2"></div>
                <div class="smoke smoke-3"></div>
            </div>
        </div>

        <!-- Error Text -->
        <div class="error-text">
            <h1>404</h1>
            <h2>Shipment Crashed!</h2>
            <p>Oops! Something went wrong. Your page has been damaged in transit. We're working to recover the package.
            </p>
        </div>

        <!-- Actions -->
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <span>Return Home</span>
            </a>
            <a href="/contact-us" class="btn btn-outline">
                <span>Get Help</span>
            </a>
        </div>

        <!-- Floating Elements -->
        <div class="floating-elements">
            <div class="elem e1">🚛</div>
            <div class="elem e2">📦</div>
            <div class="elem e3">⚠️</div>
            <div class="elem e4">🛣️</div>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        :root {
            --theme-color1: #0B4654;
            --theme-color2: #FF6D45;
            --text-white: #ffffff;
            --text-gray: #cbd5e1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--theme-color1);
            color: var(--text-white);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            width: 90%;
            max-width: 1100px;
            align-items: center;
            gap: 3rem;
        }

        .content-side {
            z-index: 2;
        }

        h1 {
            font-size: 10rem;
            font-weight: 900;
            line-height: 1;
            color: var(--theme-color2);
            text-shadow: 0 10px 40px rgba(255, 109, 69, 0.4);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-white);
        }

        p {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 2.5rem;
            line-height: 1.7;
            max-width: 400px;
        }

        .btn-home {
            background-color: var(--theme-color2);
            color: #fff;
            padding: 1rem 2.5rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 25px rgba(255, 109, 69, 0.35);
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(255, 109, 69, 0.5);
        }

        /* TRUCK SCENE */
        .scene-side {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .truck-wrapper {
            position: absolute;
            width: 380px;
            height: 200px;
            transform: translateX(600px);
            opacity: 0;
        }

        .truck-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 15px 20px rgba(0,0,0,0.4));
        }

        /* TRUCK COLORS */
        .truck-cargo {
            fill: #ffffff;
            stroke: #e2e8f0;
            stroke-width: 2;
        }

        .truck-cab {
            fill: var(--theme-color2);
        }

        .truck-window {
            fill: #1a1a1a;
            fill-opacity: 0.8;
        }

        .truck-wheel {
            fill: #222;
        }

        .truck-wheel-center {
            fill: #555;
        }

        .truck-bumper {
            fill: #444;
        }

        .truck-light-red {
            fill: #e74c3c;
        }

        .truck-light-yellow {
            fill: #f1c40f;
        }

        /* DAMAGE CRACKS */
        .damage-crack {
            stroke: #333;
            stroke-width: 3;
            fill: none;
            opacity: 0;
        }

        .damage-crack.show {
            opacity: 1;
        }

        /* DEBRIS */
        .debris {
            position: absolute;
            background: #555;
            border-radius: 2px;
            opacity: 0;
        }

        .debris.show {
            animation: debrisFly 0.8s ease-out forwards;
        }

        /* IMPACT FLASH */
        .impact-flash {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 109, 69, 0.6) 0%, transparent 70%);
            opacity: 0;
            transform: translate(-50%, -50%);
        }

        .impact-flash.show {
            animation: flash 0.5s ease-out forwards;
        }

        @keyframes driveIn {
            0% { transform: translateX(600px); opacity: 0; }
            10% { transform: translateX(500px); opacity: 1; }
            60% { transform: translateX(-40px); opacity: 1; }
            75% { transform: translateX(20px); opacity: 1; }
            90% { transform: translateX(-10px); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes crashShake {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            10% { transform: translateX(-8px) rotate(-2deg); }
            25% { transform: translateX(10px) rotate(3deg); }
            40% { transform: translateX(-6px) rotate(-2deg); }
            55% { transform: translateX(4px) rotate(1deg); }
            70% { transform: translateX(-2px); }
            100% { transform: translateX(0) rotate(0deg); }
        }

        @keyframes flash {
            0% { opacity: 1; transform: translate(-50%, -50%) scale(0.5); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(2); }
        }

        @keyframes debrisFly {
            0% { 
                transform: translate(0, 0) rotate(0deg); 
                opacity: 1; 
            }
            100% { 
                transform: translate(var(--tx), var(--ty)) rotate(var(--rot)); 
                opacity: 0; 
            }
        }

        @keyframes textShake {
            0%, 100% { transform: translateX(0); }
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .scene-side {
                height: 280px;
                order: -1;
            }

            h1 { font-size: 7rem; }
            h2 { font-size: 1.5rem; }
            p { margin: 0 auto 2rem auto; }
            
            .truck-wrapper {
                width: 280px;
                height: 150px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content-side">
            <h1 id="error-text">404</h1>
            <h2>Page Not Found</h2>
            <p>The delivery truck crashed before reaching your destination. Let's get you back on the road.</p>
            <a href="/" class="btn-home">Go to Homepage</a>
        </div>

        <div class="scene-side">
            <div class="impact-flash" id="impact"></div>
            
            <div class="truck-wrapper" id="truck">
                <svg class="truck-svg" viewBox="0 0 380 200">
                    <!-- Cargo Box (Back) -->
                    <rect x="30" y="45" width="200" height="110" rx="8" class="truck-cargo"/>
                    
                    <!-- Cargo Box Details -->
                    <rect x="45" y="60" width="60" height="40" rx="3" fill="none" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="115" y="60" width="60" height="40" rx="3" fill="none" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="185" y="60" width="30" height="40" rx="3" fill="none" stroke="#cbd5e1" stroke-width="2"/>
                    
                    <!-- Cab -->
                    <path d="M235,75 L310,75 L310,155 L235,155 Z" class="truck-cab"/>
                    <path d="M245,85 L300,85 L300,120 L245,120 Z" class="truck-window"/>
                    
                    <!-- Details -->
                    <rect x="235" y="65" width="75" height="12" fill="rgba(0,0,0,0.2)"/>
                    
                    <!-- Bumper -->
                    <rect x="20" y="145" width="20" height="12" rx="2" class="truck-bumper"/>
                    <rect x="305" y="145" width="15" height="12" rx="2" class="truck-bumper"/>
                    
                    <!-- Lights -->
                    <circle cx="308" cy="140" r="5" class="truck-light-red"/>
                    <circle cx="22" cy="140" r="4" class="truck-light-yellow"/>
                    
                    <!-- Wheels -->
                    <g id="wheels">
                        <circle cx="90" cy="160" r="28" class="truck-wheel"/>
                        <circle cx="90" cy="160" r="12" class="truck-wheel-center"/>
                        <circle cx="250" cy="160" r="28" class="truck-wheel"/>
                        <circle cx="250" cy="160" r="12" class="truck-wheel-center"/>
                    </g>
                    
                    <!-- Cracks (Hidden) -->
                    <path d="M50,55 L65,80 L55,100" class="damage-crack" id="crack1"/>
                    <path d="M130,50 L145,70 L135,90" class="damage-crack" id="crack2"/>
                    <path d="M240,55 L255,75" class="damage-crack" id="crack3"/>
                </svg>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const truck = document.getElementById('truck');
            const impact = document.getElementById('impact');
            const errorText = document.getElementById('error-text');
            
            // Start: Drive in animation after 0.5s
            setTimeout(() => {
                truck.style.animation = 'driveIn 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards';
            }, 500);
            
            // Crash after driving finishes (1.2s + buffer)
            setTimeout(() => {
                // Stop wheels spinning
                const wheelCenters = truck.querySelectorAll('.truck-wheel-center');
                wheelCenters.forEach(w => w.style.display = 'none'); // hide center to show damaged wheels
                
                // Impact flash
                const truckRect = truck.getBoundingClientRect();
                const sceneRect = document.querySelector('.scene-side').getBoundingClientRect();
                impact.style.left = (truckRect.left - sceneRect.left + 50) + 'px';
                impact.style.top = (truckRect.top - sceneRect.top + 80) + 'px';
                impact.classList.add('show');
                
                // Shake text
                errorText.style.animation = 'textShake 0.6s ease-out';
                
                // Shake truck
                truck.style.animation = 'crashShake 0.8s ease-out';
                
                // Show cracks
                setTimeout(() => {
                    document.getElementById('crack1').classList.add('show');
                    document.getElementById('crack2').classList.add('show');
                    document.getElementById('crack3').classList.add('show');
                }, 200);
                
                // Create debris
                setTimeout(createDebris, 300);
                
            }, 1800);
            
            function createDebris() {
                const wrapper = document.querySelector('.scene-side');
                
                for (let i = 0; i < 10; i++) {
                    const piece = document.createElement('div');
                    piece.classList.add('debris');
                    
                    const size = Math.random() * 12 + 6;
                    piece.style.width = size + 'px';
                    piece.style.height = (Math.random() * 8 + 4) + 'px';
                    piece.style.background = Math.random() > 0.5 ? '#666' : '#888';
                    
                    // Position at front of truck
                    const leftPos = truck.offsetLeft + 50 + (Math.random() * 60);
                    const topPos = truck.offsetTop + 60 + (Math.random() * 80);
                    
                    piece.style.left = leftPos + 'px';
                    piece.style.top = topPos + 'px';
                    
                    // Fly direction (left and up)
                    const tx = -(Math.random() * 200 + 50) + 'px';
                    const ty = -(Math.random() * 150 + 20) + 'px';
                    const rot = Math.random() * 500 + 'deg';
                    
                    piece.style.setProperty('--tx', tx);
                    piece.style.setProperty('--ty', ty);
                    piece.style.setProperty('--rot', rot);
                    
                    wrapper.appendChild(piece);
                    
                    setTimeout(() => {
                        piece.classList.add('show');
                    }, i * 40);
                }
            }
        });
    </script>
</body>
</html> --}}
