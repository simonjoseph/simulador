<?php
session_start();
if (isset($_SESSION["success"])) {
    echo "<div class='alert alert-success' style='text-align: center; background: green; color: #fff;'>" . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}
if (isset($_SESSION["error"])) {
    echo "<div class='alert alert-danger'>" . $_SESSION["error"] . "</div>";
    unset($_SESSION["error"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="public/css/style.css">

    <style>
        /*  */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary-color: #f8fafc;
            --accent-color: #06b6d4;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --text-color: #1e293b;
            /* --text-color: #43b029; */
            --text-light: #64748b;
            --border-color: #e2e8f0;
            /* --background: #f1f5f9; */
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--background);
            padding: 30px 20px;
        }

        .result-container {
            max-width: 850px;
            margin: 0 auto;
            background: linear-gradient(to bottom right, white, var(--secondary-color));
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .header-pdf {
            /* background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); */
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }

        .header-pdf::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(rgba(255, 255, 255, 0.1), transparent 70%);
            transform: rotate(-45deg);
            pointer-events: none;
        }

        .header-pdf h2 {
            margin: 0;
            font-weight: 700;
            font-size: 28px;
            position: relative;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-pdf p {
            margin-top: 8px;
            font-weight: 300;
            opacity: 0.9;
            font-size: 16px;
        }

        .section-pdf {
            padding: 25px 30px;
            position: relative;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .section-pdf:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .section-pdf:last-child {
            border-bottom: none;
        }

        .section-pdf-icon {
            width: 36px;
            height: 36px;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            left: 30px;
        }

        .section-pdf-content {
            padding-left: 50px;
        }

        h4 {
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 20px;
            display: inline-block;
            position: relative;
        }

        h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 50px;
            height: 3px;
            /* background: linear-gradient(to right, var(--primary-color), var(--accent-color)); */
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        .grid-container-pdf {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .result-detail-pdf {
            display: flex;
            flex-direction: column;
            padding: 12px 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .result-detail-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .result-label-pdf {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .result-value-pdf {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-color);
        }

        .result-value-pdf:empty::after {
            content: "—";
            color: var(--text-light);
            font-style: italic;
        }

        .total-section-pdf {
            background: linear-gradient(to bottom, #f9fafb, #f1f5f9);
            padding: 30px;
        }

        .price-details-pdf {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .price-item-pdf {
            padding: 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .price-label-pdf {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .price-value-pdf {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
        }

        .cta-button-pdf {
            display: block;
            width: 100%;
            padding: 14px;
            margin-top: 25px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            font-family: 'Poppins', sans-serif;
        }

        .cta-button-pdf:hover {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            /* transform: translateY(-2px);
      box-shadow: 0 7px 14px rgba(37, 99, 235, 0.25); */

            transform: translateY(-5px);
            box-shadow: 0 10px 20px var(--secondary);
        }

        .cta-button-pdf:active {
            transform: translateY(1px);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-container {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .section-pdf:nth-child(2) {
            animation-delay: 0.1s;
        }

        .section-pdf:nth-child(3) {
            animation-delay: 0.2s;
        }

        .section-pdf:nth-child(4) {
            animation-delay: 0.3s;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header-pdf h2 {
                font-size: 24px;
            }

            .grid-container-pdf,
            .price-details-pdf {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .section-pdf {
                padding: 20px;
            }

            .section-pdf-content {
                padding-left: 0;
                margin-top: 20px;
            }

            .section-pdf-icon {
                position: static;
                margin-bottom: 15px;
            }
        }

        /*  */
        /*  */
        /*  */
        /*  */
        /*  */
        /*  */
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #00C389;
            /* background-color: #43b029; */
            /* background-color: #1e272e; */
            margin: 1% auto;
            padding: 20px;
            border: 1px solid #00c389;
            width: 80%;
            /* max-width: 800px; */
            max-width: 1000px;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .close {
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #00ff88;
            text-decoration: none;
            cursor: pointer;
        }

        .simulator-form {
            display: none;
            /* Hidden by default inside the modal */
        }

        /* Multi-step Form Styles */
        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
        }

        .step-button {
            margin-top: 1rem;
            margin-bottom: 1rem;
            margin-left: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Error Styles */
        .form-group.error input,
        .form-group.error select {
            border-color: red;
        }

        .form-group .error-message {
            color: red;
            font-size: 0.8rem;
            display: none;
        }

        .form-group.error .error-message {
            display: block;
        }

        /* see init */
        /* see end */
        .step-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* max-width: 500px; */
            padding: 30px;
            transform: translateY(30px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
            opacity: 0;
            transform: translateX(-20px);
        }

        .form-group:nth-child(1) {
            animation: slideIn 0.3s 0.1s forwards;
        }

        .form-group:nth-child(2) {
            animation: slideIn 0.3s 0.2s forwards;
        }

        .form-group:nth-child(3) {
            animation: slideIn 0.3s 0.3s forwards;
        }

        .form-group:nth-child(4) {
            animation: slideIn 0.3s 0.4s forwards;
        }

        .form-group:nth-child(5) {
            animation: slideIn 0.3s 0.5s forwards;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            transition: color 0.3s;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            outline: none;
        }

        input:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 3px rgba(110, 142, 251, 0.2);
        }

        input.error {
            border-color: #ff5252;
            animation: shake 0.3s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        .error-message {
            color: #ff5252;
            font-size: 14px;
            margin-top: 5px;
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s;
        }

        .error-message.visible {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* 
        .cta-button {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            opacity: 0;
            transform: translateY(20px);
            animation: buttonFadeIn 0.4s 0.7s forwards;
        } */

        @keyframes buttonFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cta-button:active {
            transform: translateY(1px);
        }

        .form-group.success label {
            color: #28a745;
        }

        .form-group.success input {
            border-color: #28a745;
        }

        .form-group.error label {
            color: #ff5252;
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* see init */
        /* .container {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        } */

        .custom-select-container {
            position: relative;
            width: 100%;
        }

        .select-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s;
            outline: none;
            cursor: text;
            z-index: 1000;
        }

        .select-input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .select-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 300px;
            background-color: white;
            /* background-color: rgba(0, 0, 0, 0.2); */
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            display: none;
            margin-top: 5px;
        }

        .select-input {
            z-index: 10000;
            position: relative;
        }


        .select-dropdown.active {
            display: block;
            animation: fadeIn 0.2s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .option-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .option-item:hover {
            background-color: #f5f7fa;
        }

        .option-item.selected {
            background-color: #e8f0fe;
            color: #4a90e2;
            font-weight: 500;
        }

        .no-results {
            padding: 12px 15px;
            color: #888;
            font-style: italic;
        }

        .create-option {
            padding: 12px 15px;
            color: #4a90e2;
            font-weight: 500;
            cursor: pointer;
            background-color: #f0f4ff;
            border-top: 1px solid #ddd;
        }

        .create-option:hover {
            background-color: #e8f0fe;
        }

        .hidden-select {
            position: absolute;
            opacity: 0;
            height: 0;
            width: 0;
            pointer-events: none;
        }

        /* Scrollbar customization */
        .select-dropdown::-webkit-scrollbar {
            width: 8px;
        }

        .select-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .select-dropdown::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .select-dropdown::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /**  */
        /**  */
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }

        /* Estilos para a capa */
        .capa {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 40px;
            width: 100px;
        }

        .faixas-verdes {
            position: absolute;
            top: 220px;
            left: 0;
            width: 100%;
            height: 40px;
            background-image: linear-gradient(to bottom,
                    #4D9F50 0px, #4D9F50 8px,
                    #0A8754 8px, #0A8754 16px,
                    #00A786 16px, #00A786 24px,
                    #00C0A0 24px, #00C0A0 32px,
                    #00D5B2 32px, #00D5B2 40px);
        }

        .texto-capa {
            position: absolute;
            top: 290px;
            left: 40px;
        }

        .texto-capa h1 {
            font-size: 14px;
            margin: 0 0 5px 0;
            color: #333;
            font-weight: normal;
        }

        .texto-capa h2 {
            font-size: 24px;
            margin: 0 0 5px 0;
            color: #000;
            font-weight: bold;
        }

        .texto-capa h3 {
            font-size: 16px;
            margin: 0;
            color: #333;
        }

        .rodape-capa {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background-color: #4D9F50;
            display: flex;
            align-items: center;
        }

        .contatos {
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 100%;
            height: 20px;
            background-color: #f5f5f5;
            padding-left: 25px;
        }

        .contatos span {
            font-size: 10px;
            margin-right: 15px;
        }

        .redes-sociais {
            text-align: right;
            padding-right: 40px;
        }

        /* Estilos para as páginas de conteúdo */
        .content-page {
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 5px 0;
        }

        .info-box {
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 10px;
        }

        .info-box h2 {
            font-size: 14px;
            margin: 0 0 5px 0;
            background-color: #f5f5f5;
            padding: 5px;
        }

        .row {
            display: block;
            width: 100%;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .col {
            float: left;
            width: 48%;
        }

        .label {
            font-weight: bold;
            display: block;
        }

        .value {
            display: block;
            border-bottom: 1px dotted #ccc;
            padding: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            padding: 1rem;
        }

        @media (max-width: 600px) {
            .button-container {
                justify-content: center;
            }
        }


        /**  */
        /**  */

        /* see end */
    </style>
</head>

<body>

    <section class="hero" id="home">
        <div id="particles"></div>
        <!-- <h1>Simuladores Tranquilidade</h1> -->
        <!-- <p>Descubra o melhor seguro para você com nossos simuladores inteligentes. Tecnologia avançada para proteger o
            que importa.</p> -->
        <!-- <button class="cta-button" id="start-simulator">Simular Agora</button> -->
    </section>

    <section class="simulators" id="simulators">
        <div class="container">
            <h2 class="section-title">Nossos Simuladores</h2>
            <div class="simulators-container">
                <div class="simulator-card" data-type="auto">
                    <h3>Seguro Auto</h3>
                    <p>Proteção completa para seu veículo com as melhores coberturas do mercado.</p>
                    <button class="cta-button simulator-button">Simular</button>
                </div>

                <div class="simulator-card" data-type="life">
                    <h3>Seguro de Vida</h3>
                    <p>Tranquilidade para você e sua família com coberturas personalizadas.</p>
                    <button class="cta-button simulator-button">Simular</button>
                </div>

                <div class="simulator-card" data-type="home">
                    <h3>Seguro de Viagem</h3>
                    <p>Proteja seu lar contra imprevistos e conte com assistência 24h.</p>
                    <button class="cta-button simulator-button">Simular</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>

            <!-- Formulário de Simulação Auto -->
            <div class="simulator-form" id="auto-form">
                <h3>Simulador de Seguro Auto</h3>
                <form id="form-simulacao">
                    <div class="step-1 step-container active" id="step1">
                        <div class="form-group">
                            <div class="container1">
                                <label class="radio-container">
                                    <input type="radio" name="vehicle" value="mota" onchange="updateSelectOptions('mota')">
                                    <div class="radio-label">
                                        <img src="https://cdn-icons-png.flaticon.com/128/2975/2975510.png" alt="Mota">
                                        <span>Motociclos</span>
                                    </div>
                                </label>

                                <label class="radio-container">
                                    <input type="radio" name="vehicle" value="ligeiro"
                                        onchange="updateSelectOptions('ligeiro')">
                                    <div class="radio-label">
                                        <img src="https://cdn-icons-png.flaticon.com/128/2211/2211392.png" alt="Ligeiro">
                                        <span>Ligeiro</span>
                                    </div>
                                </label>

                                <label class="radio-container">
                                    <input type="radio" name="vehicle" value="misto"
                                        onchange="updateSelectOptions('misto')">
                                    <div class="radio-label">
                                        <img src="https://cdn-icons-png.flaticon.com/128/2134/2134964.png" alt="Misto">
                                        <span>Misto</span>
                                    </div>
                                </label>

                                <label class="radio-container">
                                    <input type="radio" name="vehicle" value="caminhao"
                                        onchange="updateSelectOptions('caminhao')">
                                    <div class="radio-label">
                                        <img src="https://cdn-icons-png.flaticon.com/128/8502/8502414.png" alt="Caminhão">
                                        <span>Caminhão</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- <button class="cta-button step-button next-step">Próximo</button> -->
                    </div>

                    <div class="step-2 step-container" id="step2">
                        <div class="form-group">
                            <div class="container1" id="radiobtnCategory">
                            </div>
                        </div>

                        <div class="button-container">
                            <button type="button" class="cta-button step-button prev-step cta-right">Anterior</button>
                        </div>

                        <!-- <button class="cta-button step-button prev-step">Anterior</button> -->
                        <!-- <button class="cta-button step-button next-step">Próximo</button> -->
                    </div>

                    <div class="step-3 step-container" id="step3">
                        <div class="form-group" id="">
                            <div class="container1">
                                <?php foreach ($campanhas as $campanha): ?>
                                    <!--  -->
                                    <label class="radio-container">
                                        <input type="radio" id="<?= htmlspecialchars($campanha["id"]) ?>" name="campanha" onclick="moveToNextStepCampanha(this)" value="<?= htmlspecialchars($campanha["percentagem"]) ?>">
                                        <div class="radio-label">
                                            <img src="https://cdn-icons-png.flaticon.com/128/7213/7213392.png" alt="<?= htmlspecialchars($campanha["nome"]) ?>">
                                            <span><?= htmlspecialchars($campanha["nome"]) ?> - <?= htmlspecialchars($campanha["percentagem"]) ?>%</span>
                                            <span>Válido de <?= htmlspecialchars($campanha["data_inicio"]) ?> á <?= htmlspecialchars($campanha["data_fim"]) ?></span>
                                        </div>
                                    </label>

                                <?php endforeach; ?>
                                <!--  -->
                                <label class="radio-container">
                                    <input type="radio" id="semCampanha" name="campanha" onclick="moveToNextStepCampanha(this)" value="Não se aplica">
                                    <div class="radio-label">
                                        <img src="https://cdn-icons-png.flaticon.com/128/10492/10492351.png" alt="Mota">
                                        <span>Não se aplica as campanhas</span>
                                    </div>
                                </label>
                                <!--  -->
                            </div>
                        </div>

                        <div class="button-container">
                            <button type="button" class="cta-button step-button prev-step cta-right">Anterior</button>
                        </div>
                        <!-- <button class="cta-button step-button prev-step">Anterior</button> -->
                        <!-- <button class="cta-button step-button next-step">Próximo</button> -->
                    </div>

                    <div class="step-4 step-container" id="step4">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="auto-matricula">Matricula</label>
                                <input type="text" id="auto-matricula" required placeholder="Ex: LD-00-00">
                                <span class="error-message">Por favor, preencha o nome completo.</span>
                            </div>

                            <div class="form-group">
                                <label for="auto-cilindrada">Cilindrada</label>
                                <!-- <input type="text" id="auto-cilindrada" placeholder="Cilindrada do Veículo"> -->
                                <select id="auto-cilindrada" required>
                                    <option value="">Selecione a cilindrada do Veículo</option>
                                    <span class="error-message">Por favor, preencha o nome completo.</span>
                                </select>
                                <!-- <input type="number" id="auto-cilindrada" placeholder="Informe a cilindrada" required /> -->

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="auto-year">Ano do Veículo</label>
                                <input type="text" id="auto-year" min="1900" max="2100" required placeholder="AAAA" title="Insira um ano de 4 dígitos">
                                <span class="error-message">Por favor, preencha o nome completo.</span>
                            </div>
                            <div class="form-group">
                                <label for="auto-data">Data de Início</label>
                                <input type="date" id="auto-data" placeholder="Data" required>
                                <span class="error-message">Por favor, preencha o nome completo.</span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="auto-marca">Marca</label>
                                <!-- <input type="text" id="auto-marca" placeholder="Marca do Veículo"> -->
                                <!-- k -->
                                <div class="custom-select-container">
                                    <input type="text" id="brand-search" class="select-input" placeholder="Digite para pesquisar uma marca" autocomplete="off">
                                    <div class="select-dropdown" id="brand-dropdown"></div>

                                    <!-- Select original (oculto) -->
                                    <select id="auto-marca" class="hidden-select">
                                        <option value="">-- Escolha --</option>
                                        <option value="ACESSMAQ">ACESSMAQ</option>
                                        <option value="Actm">Actm</option>
                                        <option value="Acura">Acura</option>
                                        <option value="AGIR-H">AGIR-H</option>
                                        <option value="AJS">AJS</option>
                                        <option value="Alfa Romeo">Alfa Romeo</option>
                                        <option value="Alzaga">Alzaga</option>
                                        <option value="Apollo">Apollo</option>
                                        <option value="ARB">ARB</option>
                                        <option value="Ashok">Ashok</option>
                                        <option value="Astra">Astra</option>
                                        <option value="Atrelado">Atrelado</option>
                                        <option value="Audi">Audi</option>
                                        <option value="AUREPA">AUREPA</option>
                                        <option value="Axle flatdeck">Axle flatdeck</option>
                                        <option value="BADORA">BADORA</option>
                                        <option value="Baic">Baic</option>
                                        <option value="Baja">Baja</option>
                                        <option value="Baldex">Baldex</option>
                                        <option value="BASHAN">BASHAN</option>
                                        <option value="Basmaior">Basmaior</option>
                                        <option value="BAW">BAW</option>
                                        <option value="Bmw">Bmw</option>
                                        <option value="BODA">BODA</option>
                                        <option value="Borgward">Borgward</option>
                                        <option value="Boxer">Boxer</option>
                                        <option value="BYD">BYD</option>
                                        <option value="Cadillac">Cadillac</option>
                                        <option value="Camc">Camc</option>
                                        <option value="Case">Case</option>
                                        <option value="Cat">Cat</option>
                                        <option value="CFMOTO">CFMOTO</option>
                                        <option value="Chana">Chana</option>
                                        <option value="Changan">Changan</option>
                                        <option value="CHENGHWEN">CHENGHWEN</option>
                                        <option value="Cherokee">Cherokee</option>
                                        <option value="Chery">Chery</option>
                                        <option value="Chevrolet">Chevrolet</option>
                                        <option value="Chrysler">Chrysler</option>
                                        <option value="Cimar">Cimar</option>
                                        <option value="Cimc">Cimc</option>
                                        <option value="Cimic">Cimic</option>
                                        <option value="CISFRA">CISFRA</option>
                                        <option value="Citroen">Citroen</option>
                                        <option value="Cnhtc">Cnhtc</option>
                                        <option value="CNJ">CNJ</option>
                                        <option value="COASTER">COASTER</option>
                                        <option value="Cocimecam">Cocimecam</option>
                                        <option value="Cometa">Cometa</option>
                                        <option value="Commuter">Commuter</option>
                                        <option value="CSG">CSG</option>
                                        <option value="Dacia">Dacia</option>
                                        <option value="Daf">Daf</option>
                                        <option value="Daihatsu">Daihatsu</option>
                                        <option value="Daimler">Daimler</option>
                                        <option value="Dakar">Dakar</option>
                                        <option value="Dayun">Dayun</option>
                                        <option value="DELOP">DELOP</option>
                                        <option value="Dfsk">Dfsk</option>
                                        <option value="Dodge">Dodge</option>
                                        <option value="DONG FENG">DONG FENG</option>
                                        <option value="Ducati">Ducati</option>
                                        <option value="Dump">Dump</option>
                                        <option value="Dynapac">Dynapac</option>
                                        <option value="ELGIN">ELGIN</option>
                                        <option value="F.X.MEILLER">F.X.MEILLER</option>
                                        <option value="Facchini">Facchini</option>
                                        <option value="Faw">Faw</option>
                                        <option value="FEELY">FEELY</option>
                                        <option value="Ferrari">Ferrari</option>
                                        <option value="FH15">FH15</option>
                                        <option value="Fh4">Fh4</option>
                                        <option value="Fiat">Fiat</option>
                                        <option value="Ford">Ford</option>
                                        <option value="Foton">Foton</option>
                                        <option value="Fruehauf">Fruehauf</option>
                                        <option value="FUWA">FUWA</option>
                                        <option value="Galtrailer">Galtrailer</option>
                                        <option value="Galucho">Galucho</option>
                                        <option value="GEELY">GEELY</option>
                                        <option value="Gmc">Gmc</option>
                                        <option value="GOLDEN">GOLDEN</option>
                                        <option value="Golden dragon">Golden dragon</option>
                                        <option value="GRAND CHEROKEE">GRAND CHEROKEE</option>
                                        <option value="Great wall">Great wall</option>
                                        <option value="Grove">Grove</option>
                                        <option value="GVM">GVM</option>
                                        <option value="Haima">Haima</option>
                                        <option value="Hama">Hama</option>
                                        <option value="Hammer">Hammer</option>
                                        <option value="Hawtai">Hawtai</option>
                                        <option value="Henred">Henred</option>
                                        <option value="HIGER">HIGER</option>
                                        <option value="Hino">Hino</option>
                                        <option value="Honda">Honda</option>
                                        <option value="Hong Yan">Hong Yan</option>
                                        <option value="HORYONG">HORYONG</option>
                                        <option value="HOS">HOS</option>
                                        <option value="Howo">Howo</option>
                                        <option value="Huangai">Huangai</option>
                                        <option value="Hyundai">Hyundai</option>
                                        <option value="Infiniti">Infiniti</option>
                                        <option value="INFINITY">INFINITY</option>
                                        <option value="INTERNATIONAL">INTERNATIONAL</option>
                                        <option value="Invepe">Invepe</option>
                                        <option value="Isuzu">Isuzu</option>
                                        <option value="Iveco">Iveco</option>
                                        <option value="Jac">Jac</option>
                                        <option value="Jaguar">Jaguar</option>
                                        <option value="Jeep">Jeep</option>
                                        <option value="Jetour">Jetour</option>
                                        <option value="Jiefang">Jiefang</option>
                                        <option value="Jinbei">Jinbei</option>
                                        <option value="Jincheng">Jincheng</option>
                                        <option value="Jmc">Jmc</option>
                                        <option value="Jog">Jog</option>
                                        <option value="Joluso">Joluso</option>
                                        <option value="KAIYI">KAIYI</option>
                                        <option value="KALELUYA">KALELUYA</option>
                                        <option value="Kamaz">Kamaz</option>
                                        <option value="Kawasaki">Kawasaki</option>
                                        <option value="Kearney">Kearney</option>
                                        <option value="Keeway">Keeway</option>
                                        <option value="KENWORTH">KENWORTH</option>
                                        <option value="Keweseki">Keweseki</option>
                                        <option value="Kia">Kia</option>
                                        <option value="KINFAN">KINFAN</option>
                                        <option value="KINGLONG">KINGLONG</option>
                                        <option value="Komatsu">Komatsu</option>
                                        <option value="Krone">Krone</option>
                                        <option value="KRONORTE">KRONORTE</option>
                                        <option value="Ktm">Ktm</option>
                                        <option value="Lamberete">Lamberete</option>
                                        <option value="Lamborghini">Lamborghini</option>
                                        <option value="Land rover">Land rover</option>
                                        <option value="LANDINI">LANDINI</option>
                                        <option value="Lecinena">Lecinena</option>
                                        <option value="LECITRAILER">LECITRAILER</option>
                                        <option value="Leopard">Leopard</option>
                                        <option value="Lexus">Lexus</option>
                                        <option value="Lifan">Lifan</option>
                                        <option value="Lincoln">Lincoln</option>
                                        <option value="Lingken">Lingken</option>
                                        <option value="LISTRAILER">LISTRAILER</option>
                                        <option value="Lohr">Lohr</option>
                                        <option value="Lufeng">Lufeng</option>
                                        <option value="MACK">MACK</option>
                                        <option value="Mahindra">Mahindra</option>
                                        <option value="Man">Man</option>
                                        <option value="Maserati">Maserati</option>
                                        <option value="Maxus">Maxus</option>
                                        <option value="Mazda">Mazda</option>
                                        <option value="Mercedes">Mercedes</option>
                                        <option value="MERLO">MERLO</option>
                                        <option value="METALESP">METALESP</option>
                                        <option value="METALOVOUGA">METALOVOUGA</option>
                                        <option value="MG">MG</option>
                                        <option value="Mike Bike">Mike Bike</option>
                                        <option value="Mini">Mini</option>
                                        <option value="Mitsubishi">Mitsubishi</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="MOTOANGOLA">MOTOANGOLA</option>
                                        <option value="N1 Mars">N1 Mars</option>
                                        <option value="Nissan">Nissan</option>
                                        <option value="Noma">Noma</option>
                                        <option value="Olong">Olong</option>
                                        <option value="Opel">Opel</option>
                                        <option value="PEGADO">PEGADO</option>
                                        <option value="Peugeot">Peugeot</option>
                                        <option value="Piaggio">Piaggio</option>
                                        <option value="Porsche">Porsche</option>
                                        <option value="Porta Maquina">Porta Maquina</option>
                                        <option value="Randon">Randon</option>
                                        <option value="Range rover">Range rover</option>
                                        <option value="RAVO">RAVO</option>
                                        <option value="Remolque">Remolque</option>
                                        <option value="Renault">Renault</option>
                                        <option value="Retroescavadeira">Retroescavadeira</option>
                                        <option value="Rio Trailer">Rio Trailer</option>
                                        <option value="RODOLINEA">RODOLINEA</option>
                                        <option value="Rouco">Rouco</option>
                                        <option value="SANY">SANY</option>
                                        <option value="Scania">Scania</option>
                                        <option value="Seat">Seat</option>
                                        <option value="Semi Reboque">Semi Reboque</option>
                                        <option value="Shacman">Shacman</option>
                                        <option value="SHAN QI">SHAN QI</option>
                                        <option value="Sinotruck">Sinotruck</option>
                                        <option value="SINOTRUK HOWO">SINOTRUK HOWO</option>
                                        <option value="Ssangyong">Ssangyong</option>
                                        <option value="Steelbro">Steelbro</option>
                                        <option value="STEYER">STEYER</option>
                                        <option value="Suzuki">Suzuki</option>
                                        <option value="TAILOR">TAILOR</option>
                                        <option value="Tata">Tata</option>
                                        <option value="Terex">Terex</option>
                                        <option value="Titan">Titan</option>
                                        <option value="TLEQUIP TLTES">TLEQUIP TLTES</option>
                                        <option value="Tonghua">Tonghua</option>
                                        <option value="Toyota">Toyota</option>
                                        <option value="Trailer">Trailer</option>
                                        <option value="TRALLOR">TRALLOR</option>
                                        <option value="Truck">Truck</option>
                                        <option value="TVS">TVS</option>
                                        <option value="Unimog">Unimog</option>
                                        <option value="URAL">URAL</option>
                                        <option value="VALART">VALART</option>
                                        <option value="Venter">Venter</option>
                                        <option value="Vespa">Vespa</option>
                                        <option value="Volare">Volare</option>
                                        <option value="Volkswagen">Volkswagen</option>
                                        <option value="Volvo">Volvo</option>
                                        <option value="WABCO">WABCO</option>
                                        <option value="Wuling">Wuling</option>
                                        <option value="Xcmg">Xcmg</option>
                                        <option value="XING YONG">XING YONG</option>
                                        <option value="YAMAHA">YAMAHA</option>
                                        <option value="Yamaha 125">Yamaha 125</option>
                                        <option value="Yamang">Yamang</option>
                                        <option value="Yaxing">Yaxing</option>
                                        <option value="YUEJIN">YUEJIN</option>
                                        <option value="Yutong">Yutong</option>
                                        <option value="Zenza">Zenza</option>
                                        <option value="Zoomlion">Zoomlion</option>
                                        <option value="Zxauto">Zxauto</option>
                                    </select>
                                </div>
                                <!--  -->
                            </div>

                            <div class="form-group">
                                <label for="auto-modelo">Modelo</label>
                                <input type="text" id="auto-modelo" required placeholder="Modelo do Veículo">
                            </div>

                        </div>

                        <div class="button-container">
                            <button type="button" class="cta-button step-button prev-step cta-right">Anterior</button>
                            <button type="button" class="cta-button step-button next-step">Próximo</button>
                        </div>
                        <!-- <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button step-button next-step">Próximo</button> -->
                    </div>

                    <div class="step-5 step-container" id="step5">
                        <div class="form-group">
                            <label for="full-name">Nome Completo</label>
                            <input type="text" id="full-name" placeholder="Digite seu nome completo" required>
                            <span class="error-message">Por favor, preencha o nome completo.</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Digite seu email" required>
                            <span class="error-message">Por favor, preencha um email válido.</span>
                        </div>
                        <div class="form-group">
                            <label for="nif">NIF</label>
                            <input type="text" id="nif" placeholder="Digite seu NIF" required>
                            <span class="error-message">Por favor, preencha um NIF válido (14 dígitos).</span>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contato</label>
                            <input type="tel" id="contact" placeholder="Digite seu número de telefone" required>
                            <span class="error-message">Por favor, preencha um número de telefone válido.</span>
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço</label>
                            <input type="text" id="address" placeholder="Digite seu endereço" required>
                            <span class="error-message">Por favor, preencha o endereço.</span>
                        </div>
                        <button type="button" class="cta-button step-button prev-step">Anterior</button>
                        <button type="submit" class="cta-button step-button next-step" id="calculate-auto">Próximo</button>
                    </div>

                    <div class="step-6 step-container" id="step6">
                        <!-- <button class="cta-button step-button prev-step">Anterior</button> -->
                        <!-- <form id="form-simulacao"> -->
                        <!-- <button type="submit" class="cta-button" id="calculate-auto">Calcular</button> -->
                        <!--  -->
                        <div class="result-container" id="auto-result">
                            <div class="header-pdf">
                                <h2>Resultado da Simulação de Seguro</h2>
                                <p>Detalhes da sua cotação personalizada</p>
                            </div>

                            <div id="cotation-pdf"></div>

                            <div class="section-pdf">
                                <div class="section-pdf-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div class="section-pdf-content">
                                    <h4>Dados do Cliente</h4>
                                    <div class="grid-container-pdf">
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Nome</span>
                                            <span class="result-value-pdf" id="nome_result"></span>
                                            <input type="hidden" name="nome" id="input_nome">
                                            <!-- Inputs escondidos preenchidos via JS -->
                                            <input type="hidden" name="email" id="input_email">
                                            <input type="hidden" name="nif" id="input_nif">
                                            <input type="hidden" name="contato" id="input_contato">
                                            <input type="hidden" name="endereco" id="input_endereco">
                                            <input type="hidden" name="matricula" id="input_matricula">
                                            <input type="hidden" name="marca" id="input_marca">
                                            <input type="hidden" name="modelo" id="input_modelo">
                                            <input type="hidden" name="cilindrada" id="input_cilindrada">
                                            <input type="hidden" name="ano_fabrico" id="input_ano_fabrico">
                                            <input type="hidden" name="data_inicio" id="input_data_inicio">
                                            <input type="hidden" name="id_categoria" id="input_id_categoria">
                                            <input type="hidden" name="premio_rc_legal" id="input_premio_rc_legal">
                                            <input type="hidden" name="premio_comercial_rc" id="input_premio_comercial_rc">
                                            <input type="hidden" name="campanha_id" id="input_campanha_id">
                                            <!-- Aqui vai o conteúdo da sua simulação... -->
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Email</span>
                                            <span class="result-value-pdf" id="email_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">NIF</span>
                                            <span class="result-value-pdf" id="nif_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Contato</span>
                                            <span class="result-value-pdf" id="contato_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Endereço</span>
                                            <span class="result-value-pdf" id="endereco_result"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section-pdf">
                                <div class="section-pdf-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13"></rect>
                                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                    </svg>
                                </div>
                                <div class="section-pdf-content">
                                    <h4>Dados do Automovél</h4>
                                    <div class="grid-container-pdf">
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Matricula</span>
                                            <span class="result-value-pdf" id="matricula_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Marca</span>
                                            <span class="result-value-pdf" id="marca_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Modelo</span>
                                            <span class="result-value-pdf" id="modelo_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Cilindrada</span>
                                            <span class="result-value-pdf" id="cilindrada_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Ano de fabrico</span>
                                            <span class="result-value-pdf" id="ano_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Data de inicio</span>
                                            <span class="result-value-pdf" id="data_result"></span>
                                        </div>
                                        <div class="result-detail-pdf">
                                            <span class="result-label-pdf">Categoria</span>
                                            <span class="result-value-pdf" id="categoria_result"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section-pdf total-section-pdf">
                                <div class="section-pdf-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                </div>
                                <div class="section-pdf-content">
                                    <h4>Resultado da Simulação</h4>
                                    <div class="price-details-pdf">
                                        <div class="price-item-pdf">
                                            <div class="price-label-pdf">Opção ESSENCIAL (RC)</div>
                                            <div class="price-value-pdf" id="rc_legal">AOA 0,00</div>
                                        </div>
                                        <div class="price-item-pdf">
                                            <div class="price-label-pdf">Opção ESSENCIAL PLUS (RC+POC)</div>
                                            <div class="price-value-pdf" id="comercial_rc">AOA 0,00</div>
                                        </div>
                                        <!-- <div class="price-item-pdf">
                                        <div class="price-label-pdf">Prêmio POC</div>
                                        <div class="price-value-pdf" id="premio_poc">AOA 0,00</div>
                                    </div>
                                    <div class="price-item-pdf">
                                        <div class="price-label-pdf">Prêmio QIV</div>
                                        <div class="price-value-pdf" id="premio_qiv">AOA 0,00</div>
                                    </div> -->
                                    </div>
                                    <!-- <button id="download-word" class="cta-button-pdf">
                                        Imprimir a Simulação
                                    </button> -->
                                    <button type="button" onclick="baixarPdf()" class="cta-button-pdf">
                                        Imprimir a Simulação
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <!-- </form> -->
                    </div>
                    <button type="button" class="back-button">Voltar</button>
                </form>
            </div>

            <!-- Formulário de Simulação Vida -->
            <div class="simulator-form" id="life-form">
                <h3>Simulador de Seguro de Vida</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="life-age">Idade</label>
                        <input type="number" id="life-age" placeholder="Ex: 35">
                    </div>
                    <div class="form-group">
                        <label for="life-gender">Gênero</label>
                        <select id="life-gender">
                            <option value="">Selecione</option>
                            <option value="male">Masculino</option>
                            <option value="female">Feminino</option>
                            <option value="other">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="coverage-value">Valor da Cobertura (AOA)</label>
                    <input type="number" id="coverage-value" placeholder="Ex: 100000">
                </div>

                <div class="form-group">
                    <label for="life-profile">Perfil de Risco</label>
                    <select id="life-profile">
                        <option value="">Selecione</option>
                        <option value="low">Baixo (Não fumante, sem doenças)</option>
                        <option value="medium">Médio (Fumante ocasional)</option>
                        <option value="high">Alto (Fumante, com condições médicas)</option>
                    </select>
                </div>

                <button class="cta-button" id="calculate-life">Calcular</button>
                <button class="back-button">Voltar</button>

                <div class="result-container" id="life-result">
                    <h4>Resultado da Simulação</h4>
                    <div class="result-detail">
                        <span class="result-label">Cobertura por Morte:</span>
                        <span class="result-value" id="death-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Cobertura por Invalidez:</span>
                        <span class="result-value" id="disability-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Cobertura por Doenças Graves:</span>
                        <span class="result-value" id="disease-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Assistência Funeral:</span>
                        <span class="result-value" id="funeral-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Total Mensal:</span>
                        <span class="result-value total-value" id="life-monthly-total">AOA 0,00</span>
                    </div>
                </div>
            </div>

            <!-- Formulário de Simulação Residencial -->
            <div class="simulator-form" id="home-form">
                <h3>Simulador de Seguro de Viagem</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="home-type">Tipo de Imóvel</label>
                        <select id="home-type">
                            <option value="">Selecione</option>
                            <option value="house">Casa</option>
                            <option value="apartment">Apartamento</option>
                            <option value="cottage">Chácara</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="home-size">Área (m²)</label>
                        <input type="number" id="home-size" placeholder="Ex: 100">
                    </div>
                </div>

                <div class="form-group">
                    <label for="home-value">Valor do Imóvel (AOA)</label>
                    <input type="number" id="home-value" placeholder="Ex: 500000">
                </div>

                <div class="form-group">
                    <label for="home-coverage">Tipo de Cobertura</label>
                    <select id="home-coverage">
                        <option value="">Selecione</option>
                        <option value="basic">Básica (Incêndio, raio)</option>
                        <option value="standard">Padrão (Básica + roubo, danos elétricos)</option>
                        <option value="premium">Premium (Todas as coberturas)</option>
                    </select>
                </div>

                <button class="cta-button" id="calculate-home">Calcular</button>
                <button class="back-button">Voltar</button>

                <div class="result-container" id="home-result">
                    <h4>Resultado da Simulação</h4>
                    <div class="result-detail">
                        <span class="result-label">Cobertura Contra Incêndio:</span>
                        <span class="result-value" id="fire-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Cobertura Contra Roubo:</span>
                        <span class="result-value" id="home-theft-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Cobertura Contra Danos Elétricos:</span>
                        <span class="result-value" id="electrical-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Assistência 24h:</span>
                        <span class="result-value" id="home-assistance-value">AOA 0,00</span>
                    </div>
                    <div class="result-detail">
                        <span class="result-label">Total Mensal:</span>
                        <span class="result-value total-value" id="home-monthly-total">AOA 0,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script> window.chtlConfig = { chatbotId: "8686992867" } </script>
<script async data-id="8686992867" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>

    <script>
        const options = <?php echo json_encode($modeloCategorias); ?>;
        const optionsTarifas = <?php echo json_encode($tarifas); ?>;
    </script>

    <script>
        // Definindo a data de amanhã como padrão
        const hoje = new Date();
        const amanha = new Date(hoje);
        amanha.setDate(hoje.getDate() + 1);
        const ano = amanha.getFullYear();
        const mes = String(amanha.getMonth() + 1).padStart(2, '0'); // Meses começam do 0
        const dia = String(amanha.getDate()).padStart(2, '0');

        // Formato YYYY-MM-DD
        const dataMinima = `${ano}-${mes}-${dia}`;
        document.getElementById('auto-data').min = dataMinima;
        document.getElementById('auto-data').value = dataMinima; // Define a data de amanhã como valor padrão

        function updateSelectOptions(vehicleType) {
            const radiobtnCategory = document.getElementById("radiobtnCategory");
            radiobtnCategory.innerHTML = ""; // Limpa as opções

            // Criar um mapeamento das categorias baseado no nome
            const categoryMapping = {
                mota: "Motociclos",
                ligeiro: "Ligeiros",
                misto: "Mistos",
                caminhao: "Camião"
            };

            // Filtrar os dados do PHP conforme o tipo de veículo selecionado
            const filteredOptions = options.filter(option =>
                option.nome.includes(categoryMapping[vehicleType])
            );

            // Criar os botões de rádio dinamicamente
            filteredOptions.forEach(optionData => {
                const label = document.createElement("label");
                label.className = "radio-container";

                const input = document.createElement("input");
                input.type = "radio";
                input.name = "auto-categoria"; // Nome do grupo de botões de rádio
                input.value = optionData.nome;
                input.required = true;

                console.log(optionData);

                // ✅ Atualiza a cilindrada quando o botão é selecionado
                input.addEventListener("change", () => {
                    updateCilindradaSelect(optionData.nome);
                });

                const div = document.createElement("div");
                div.className = "radio-label";
                div.style.width = "auto";

                const img = document.createElement("img");
                img.src = "https://cdn-icons-png.flaticon.com/128/1455/1455324.png";
                img.alt = optionData.nome;

                const span = document.createElement("span");
                span.textContent = optionData.nome;

                div.appendChild(img);
                div.appendChild(span);
                label.appendChild(input);
                label.appendChild(div);
                radiobtnCategory.appendChild(label);

                // 
                // updateCilindradaSelect(optionData.nome);
                // 
            });
        }

        // 
        function updateCilindradaSelect(optionName) {
            const cilindradaSelect = document.getElementById("auto-cilindrada");
            cilindradaSelect.innerHTML = ""; // Limpa as opções

            // Adiciona a opção padrão
            const defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "Selecione a cilindrada do Veículo";
            cilindradaSelect.appendChild(defaultOption);

            console.log(optionName)

            // Define as opções de cilindrada com base na escolha
            let options = [];
            if (optionName.includes("até 100 cc")) {
                options = ["50 cc", "60 cc", "70 cc", "80 cc", "90 cc", "100 cc"];
            } else if (optionName.includes("entre 100 e 500 cc")) {
                options = ["100 cc", "200 cc", "300 cc", "400 cc", "500 cc"];
            } else if (optionName.includes("acima de 500 cc")) {
                options = ["500 cc", "600 cc", "700 cc", "800 cc", "900 cc", "1000 cc"];
            } else if (optionName.includes("Ligeiros até 1.600 cc")) {
                options = ["1.100 cc", "1.200 cc", "1.300 cc", "1.400 cc", "1.500 cc", "1.600 cc"];
            } else if (optionName.includes("Ligeiros de 1.600 a 2.500 cc")) {
                options = ["1.600 cc", "1.700 cc", "1.800 cc", "1.900 cc", "2000 cc", "2100 cc", "2200 cc", "2300 cc", "2400 cc", "2500 cc"];
            } else if (optionName.includes("Ligeiros acima de 2.500 cc")) {
                options = ["2.500 cc", "2.600 cc", "2.700 cc", "2.800 cc", "2.900 cc", "3000 cc"];
            } else if (optionName.includes("até 10T")) {
                options = ["1T", "2T", "3T", "4T", "5T", "6T", "7T", "8T", "9T", "10T"];
            } else if (optionName.includes("&gt;10T")) {
                options = ["10T", "20 T", "30T", "40T", "50T"];
            }

            // Adiciona as opções ao select
            options.forEach(opt => {
                const option = document.createElement("option");
                option.value = opt;
                option.textContent = opt;
                cilindradaSelect.appendChild(option);
            });
        }
        // 
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            const nextButton = document.querySelector('.next-step');

            // Adiciona foco ao primeiro campo quando a página carrega
            setTimeout(() => {
                document.getElementById('full-name').focus();
            }, 1000);

            // Validação em tempo real nos campos
            inputs.forEach(input => {
                // Evento quando o campo perde o foco
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                // Evento quando o usuário digita
                input.addEventListener('input', function() {
                    const formGroup = this.parentElement;
                    if (formGroup.classList.contains('error')) {
                        validateField(this);
                    }
                });

                // Animação quando o campo recebe foco
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('label').style.color = '#6e8efb';
                });
            });

            // Evento de clique no botão próximo
            nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                let isValid = true;

                // Valida todos os campos
                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });

                if (isValid) {
                    // Animação de sucesso
                    this.classList.add('pulse');
                    this.textContent = 'Dados Salvos!';

                    setTimeout(() => {
                        // alert('Formulário enviado com sucesso!');
                        // Aqui poderia redirecionar para o próximo passo
                    }, 1000);
                } else {
                    // Foca no primeiro campo com erro
                    document.querySelector('.form-group.error input').focus();
                }
            });

            // Função para validar campos
            function validateField(input) {
                const formGroup = input.parentElement;
                const errorMessage = formGroup.querySelector('.error-message');
                let isValid = true;
                // Removendo classes de estado
                formGroup.classList.remove('error', 'success');

                // Verifica se o campo está vazio
                if (input.value.trim() === '') {
                    showError(formGroup, errorMessage, 'Este campo é obrigatório.');
                    isValid = false;
                } else {
                    // Validações específicas por tipo de campo
                    switch (input.id) {
                        case 'email':
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(input.value)) {
                                showError(formGroup, errorMessage, 'Por favor, insira um email válido.');
                                isValid = false;
                            }
                            break;
                        case 'nif':
                            const nifRegex = /^\d{9}[A-Za-z]{2}\d{3}$/;
                            if (!nifRegex.test(input.value)) {
                                showError(formGroup, errorMessage, 'O NIF deve conter 14 dígitos.');
                                isValid = false;
                            }
                            break;
                        case 'contact':
                            const phoneRegex = /^\d{9,14}$/;
                            if (!phoneRegex.test(input.value.replace(/\D/g, ''))) {
                                showError(formGroup, errorMessage, 'Insira um número de telefone válido.');
                                isValid = false;
                            }
                            break;
                        case 'full-name':
                            if (input.value.trim().split(' ').length < 2) {
                                showError(formGroup, errorMessage, 'Insira seu nome completo.');
                                isValid = false;
                            }
                            break;
                        case 'auto-year':
                            const yearRegex = /^(19|20)\d{2}$/;
                            if (!yearRegex.test(input.value)) {
                                showError(formGroup, errorMessage, 'Insira um ano válido.');
                                isValid = false;
                            }
                            break;
                    }
                }

                // Se passou em todas as validações
                if (isValid) {
                    formGroup.classList.add('success');
                    errorMessage.classList.remove('visible');
                }
                return isValid;
            }

            // Função para mostrar erro
            function showError(formGroup, errorMessage, message) {
                formGroup.classList.add('error');
                errorMessage.textContent = message;
                errorMessage.classList.add('visible');
                formGroup.querySelector('input').classList.add('error');
                // Remove a classe de erro após a animação
                setTimeout(() => {
                    formGroup.querySelector('input').classList.remove('error');
                }, 300);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos
            const searchInput = document.getElementById('brand-search');
            const dropdown = document.getElementById('brand-dropdown');
            const originalSelect = document.getElementById('auto-marca');

            // Obtém todas as marcas do select original
            const brands = Array.from(originalSelect.options)
                .filter(option => option.value !== "") // Remove a opção "-- Escolha --"
                .map(option => option.value);

            // Lista de marcas adicionadas pelo usuário
            let customBrands = [];

            // Estado
            let selectedValue = '';
            let isDropdownOpen = false;

            // Funções
            function renderDropdownOptions(options, query = '') {
                dropdown.innerHTML = '';

                if (options.length === 0) {
                    // Se não houver resultados
                    const noResults = document.createElement('div');
                    noResults.className = 'no-results';
                    noResults.textContent = 'Nenhuma marca encontrada';
                    dropdown.appendChild(noResults);
                    // Opção para criar nova marca
                    if (query.trim() !== '') {
                        const createOption = document.createElement('div');
                        createOption.className = 'create-option';
                        createOption.textContent = `Adicionar "${query}"`;
                        createOption.addEventListener('click', () => {
                            selectBrand(query);
                            addCustomBrand(query);
                        });
                        dropdown.appendChild(createOption);
                    }
                } else {
                    // Renderiza as opções encontradas
                    options.forEach(brand => {
                        const option = document.createElement('div');
                        option.className = 'option-item';
                        if (brand === selectedValue) {
                            option.classList.add('selected');
                        }
                        // Destaca o texto pesquisado
                        if (query) {
                            const regex = new RegExp(`(${escapeRegExp(query)})`, 'gi');
                            option.innerHTML = brand.replace(regex, '<strong>$1</strong>');
                        } else {
                            option.textContent = brand;
                        }
                        option.addEventListener('click', () => {
                            selectBrand(brand);
                        });
                        dropdown.appendChild(option);
                    });
                }
            }

            // Escapa caracteres especiais para usar em regex
            function escapeRegExp(string) {
                return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            }

            // Filtra as marcas com base no texto digitado
            function filterBrands(query) {
                if (!query) return [...brands, ...customBrands];
                query = query.toLowerCase();
                const allBrands = [...brands, ...customBrands];
                return allBrands.filter(brand =>
                    brand.toLowerCase().includes(query)
                );
            }

            // Seleciona uma marca
            function selectBrand(brand) {
                selectedValue = brand;
                searchInput.value = brand;
                // Atualiza o select original
                setSelectValue(brand);
                closeDropdown();
            }

            // Adiciona uma marca personalizada
            function addCustomBrand(brand) {
                if (!brands.includes(brand) && !customBrands.includes(brand)) {
                    customBrands.push(brand);
                    // Adiciona ao select original
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    originalSelect.appendChild(option);
                }
            }

            // Define o valor no select original
            function setSelectValue(value) {
                // Verifica se o valor existe no select
                let optionExists = false;
                for (let i = 0; i < originalSelect.options.length; i++) {
                    if (originalSelect.options[i].value === value) {
                        originalSelect.selectedIndex = i;
                        optionExists = true;
                        break;
                    }
                }

                // Se o valor não existir, cria uma nova opção
                if (!optionExists && value.trim() !== '') {
                    const option = document.createElement('option');
                    option.value = value;
                    option.textContent = value;
                    originalSelect.appendChild(option);
                    originalSelect.value = value;
                }

                // Dispara o evento change para notificar outros scripts
                const event = new Event('change', {
                    bubbles: true
                });
                originalSelect.dispatchEvent(event);
            }

            // Abre o dropdown
            function openDropdown() {
                if (!isDropdownOpen) {
                    dropdown.classList.add('active');
                    isDropdownOpen = true;

                    // Filtra as opções com o texto atual
                    const filteredBrands = filterBrands(searchInput.value);
                    renderDropdownOptions(filteredBrands, searchInput.value);
                }
            }

            // Fecha o dropdown
            function closeDropdown() {
                dropdown.classList.remove('active');
                isDropdownOpen = false;
            }

            // Event listeners
            searchInput.addEventListener('focus', openDropdown);

            searchInput.addEventListener('input', () => {
                const query = searchInput.value.trim();
                const filteredBrands = filterBrands(query);
                renderDropdownOptions(filteredBrands, query);

                if (!isDropdownOpen) {
                    openDropdown();
                }
            });

            // Fecha o dropdown quando clicar fora
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                    closeDropdown();
                }
            });

            // Evita que o clique no dropdown feche o dropdown
            dropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            // Teclas de navegação
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeDropdown();
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    openDropdown();

                    const firstOption = dropdown.querySelector('.option-item');
                    if (firstOption) {
                        firstOption.classList.add('highlighted');
                    }
                } else if (e.key === 'Enter') {
                    e.preventDefault();

                    if (!isDropdownOpen) {
                        openDropdown();
                        return;
                    }

                    const highlightedOption = dropdown.querySelector('.option-item.highlighted');
                    if (highlightedOption) {
                        highlightedOption.click();
                    } else if (searchInput.value.trim() !== '') {
                        // Se não houver opção destacada, mas o input tiver valor
                        selectBrand(searchInput.value.trim());
                        addCustomBrand(searchInput.value.trim());
                    }
                }
            });
        });
    </script>

    <script>
        function formatarData() {
            // Criar um novo objeto Date para pegar a data atual
            let hoje = new Date();

            // Array com os nomes dos meses
            let meses = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];

            // Pegar o dia, mês e ano
            let dia = hoje.getDate();
            let mes = meses[hoje.getMonth()]; // Usa o mês baseado no índice (0-11)
            let ano = hoje.getFullYear();

            // Formatar a data como "10 de outubro de 2024"
            return `${dia} de ${mes} de ${ano}`;
        }

        let dataFormatada = formatarData();

        document.addEventListener('DOMContentLoaded', function() {
            // --- Helper Functions ---
            function formatCurrency(value) {
                return new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(value);
            }

            function showForm(formId) {
                const forms = document.querySelectorAll('.simulator-form');
                forms.forEach(form => {
                    form.style.display = 'none';
                });
                document.getElementById(formId).style.display = 'block';
            }

            function showResults(resultId) {
                document.getElementById(resultId).style.display = 'block';
            }

            function hideResults() {
                const results = document.querySelectorAll('.result-container');
                results.forEach(result => {
                    result.style.display = 'none';
                });
            }

            function resetResults(resultId) {
                const resultContainer = document.getElementById(resultId);
                if (resultContainer) {
                    const resultValues = resultContainer.querySelectorAll('.result-value');
                    resultValues.forEach(value => {
                        value.textContent = "AOA 0,00";
                    });
                }
            }
            // --- Modal Functions ---
            const modal = document.getElementById('myModal');
            const modalCloseButton = document.querySelector('.close');

            function openModal() {
                modal.style.display = 'block';
            }

            function closeModal() {
                modal.style.display = 'none';
            }
            // --- Form Validation ---
            function validateStep(stepId) {
                const step = document.getElementById(stepId);
                const requiredFields = step.querySelectorAll('input[required], select[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    const formGroup = field.closest('.form-group');
                    if (field.value.trim() === '') {
                        formGroup.classList.add('error');
                        isValid = false;
                    } else {
                        formGroup.classList.remove('error');
                    }
                });
                return isValid;
            }
            // --- Multi-Step Navigation ---
            let currentStep = 1;
            const nextStepButtons = document.querySelectorAll('.next-step');
            nextStepButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (currentStep === 1 && !validateStep('step1')) {
                        return;
                    }
                    if (currentStep === 2 && !validateStep('step2')) {
                        return;
                    }
                    if (currentStep === 3 && !validateStep('step3')) {
                        return;
                    }

                    const currentStepElement = document.querySelector(`.step-${currentStep}`);
                    currentStepElement.classList.remove('active');
                    currentStep++;
                    const nextStepElement = document.querySelector(`.step-${currentStep}`);
                    nextStepElement.classList.add('active');
                });
            });

            const prevStepButtons = document.querySelectorAll('.prev-step');
            prevStepButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentStepElement = document.querySelector(`.step-${currentStep}`);
                    currentStepElement.classList.remove('active');
                    currentStep--;
                    const prevStepElement = document.querySelector(`.step-${currentStep}`);
                    prevStepElement.classList.add('active');
                });
            });

            // --- Event Listeners ---
            const simulatorButtons = document.querySelectorAll('.simulator-button');
            simulatorButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const simulatorType = this.closest('.simulator-card').dataset.type;
                    openModal();
                    showForm(`${simulatorType}-form`);
                    hideResults();
                    resetResults(`${simulatorType}-result`);
                    // Reset to step 1 when opening a new form
                    const activeStep = document.querySelector(".step-container.active");
                    if (activeStep) {
                        activeStep.classList.remove("active");
                    }
                    document.getElementById("step1").classList.add("active");
                    currentStep = 1;
                });
            });

            modalCloseButton.addEventListener('click', closeModal);

            const backButtons = document.querySelectorAll('.back-button');
            backButtons.forEach(button => {
                button.addEventListener('click', function() {
                    closeModal();
                });
            });

            let id_campanha_selecionada;
            // --- Auto Calculator ---
            document.getElementById('calculate-auto').addEventListener('click', function() {
                const matricula = document.getElementById('auto-matricula').value;
                const brand = document.getElementById('auto-marca').value;
                const radios = document.getElementsByName('auto-categoria');
                const campanhas = document.getElementsByName('campanha');
                let categoria;
                let campanha_selecionada;

                for (const radio of radios) {
                    if (radio.checked) {
                        categoria = radio.value;
                        break;
                    }
                }

                for (const campanha of campanhas) {
                    if (campanha.checked) {
                        campanha_selecionada = campanha.value;
                        id_campanha_selecionada = campanha.id;
                        break;
                    }
                }

                // alert(categoria)
                const fullName = document.getElementById('full-name').value;
                const email = document.getElementById('email').value;
                const nif = document.getElementById('nif').value;
                const contact = document.getElementById('contact').value;
                const address = document.getElementById('address').value;

                const modelo = document.getElementById('auto-modelo').value;
                const cilindrada = document.getElementById('auto-cilindrada').value;
                const veiculoYear = document.getElementById('auto-year').value;
                const data_inicio = document.getElementById('auto-data').value;
                // init
                const cambio = <?= htmlspecialchars($impostos["cambio"]) ?>;
                const iva = <?= htmlspecialchars($impostos["iva"]) ?> / 100;
                const fga = <?= htmlspecialchars($impostos["fga"]) ?> / 100;
                // Função para arredondar e formatar para duas casas decimais
                const formatNumber = (num) => {
                    return (Math.round(num * 100) / 100).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                };

                // console.log(modelo, categoria)
                const linhaCategoria = optionsTarifas.find(tarifa => tarifa.nome === categoria);
                // end
                document.getElementById('nome_result').textContent = fullName;
                document.getElementById('email_result').textContent = email;
                document.getElementById('nif_result').textContent = nif;
                document.getElementById('contato_result').textContent = contact;
                document.getElementById('endereco_result').textContent = address;
                document.getElementById('modelo_result').textContent = modelo;
                document.getElementById('cilindrada_result').textContent = cilindrada;
                document.getElementById('ano_result').textContent = veiculoYear;
                document.getElementById('data_result').textContent = data_inicio;
                document.getElementById('categoria_result').textContent = categoria;
                document.getElementById('matricula_result').textContent = matricula;
                document.getElementById('marca_result').textContent = brand;

                if (campanha_selecionada == "Não se aplica") {
                    campanha_selecionada = 0
                    // id_campanha_selecionada = ""
                }

                // if (id_campanha_selecionada == "semCampanha") {
                //     id_campanha_selecionada = null
                // }

                // alert(id_campanha_selecionada)
                campanha_selecionada = campanha_selecionada / 100

                /*Resultado simulação*/
                let premio_rc_legal_without_campanha =
                    (linhaCategoria.premio_rc_legal * cambio) +
                    (linhaCategoria.premio_rc_legal * cambio * iva) +
                    (linhaCategoria.premio_rc_legal * cambio * fga);

                let premio_comercial_without_campanha =
                    (linhaCategoria.premio_rc_legal * cambio) +
                    (linhaCategoria.premio_poc * cambio) +
                    (
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * iva +
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * fga
                    );

                let result_premio_rc_legal_without_campanha = formatNumber(premio_rc_legal_without_campanha - (premio_rc_legal_without_campanha * campanha_selecionada));
                let result_premio_comercial_without_campanha = formatNumber(premio_comercial_without_campanha - (premio_comercial_without_campanha * campanha_selecionada));

                if (result_premio_rc_legal_without_campanha == result_premio_comercial_without_campanha) {
                    document.getElementById('comercial_rc').textContent = 0;
                } else {
                    document.getElementById('comercial_rc').textContent = result_premio_comercial_without_campanha;
                }
                document.getElementById('rc_legal').textContent = result_premio_rc_legal_without_campanha;
                // document.getElementById('comercial_rc').textContent = result_premio_comercial_without_campanha;

                const select = document.getElementById('auto-categoria');
                const categoriaTexto = categoria;

                const Totaldados = {
                    nome: document.getElementById('full-name').value,
                    email: document.getElementById('email').value,
                    nif: document.getElementById('nif').value,
                    contato: document.getElementById('contact').value,
                    endereco: document.getElementById('address').value,
                    matricula: document.getElementById('auto-matricula').value,
                    marca: document.getElementById('auto-marca').value,
                    modelo: document.getElementById('auto-modelo').value,
                    cilindrada: document.getElementById('auto-cilindrada').value,
                    ano: document.getElementById('auto-year').value,
                    categoria: categoriaTexto,
                    data_inicio: document.getElementById('auto-data').value,
                    rc_legal: document.getElementById('rc_legal').textContent,
                    comercial_rc: document.getElementById('comercial_rc').textContent,
                    data_actual: dataFormatada
                };
                showResults('auto-result');
            });

            // Event listener for the "Start Simulator" button in the hero section
            const startSimulatorButton = document.getElementById('start-simulator');
            startSimulatorButton.addEventListener('click', function() {
                // Scroll to the simulators section
                const simulatorsSection = document.getElementById('simulators');
                simulatorsSection.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        let urlredirect;
        // here
        document.getElementById("form-simulacao").addEventListener("submit", function(e) {
            e.preventDefault();
            // Preencher os inputs escondidos com os valores dos elementos visuais
            document.getElementById('input_nome').value = document.getElementById("nome_result").innerText;
            document.getElementById("input_email").value = document.getElementById("email_result").innerText;
            document.getElementById("input_nif").value = document.getElementById("nif_result").innerText;
            document.getElementById("input_contato").value = document.getElementById("contato_result").innerText;
            document.getElementById("input_endereco").value = document.getElementById("endereco_result").innerText;
            document.getElementById("input_matricula").value = document.getElementById("matricula_result").innerText;
            document.getElementById("input_marca").value = document.getElementById("marca_result").innerText;
            document.getElementById("input_modelo").value = document.getElementById("modelo_result").innerText;
            document.getElementById("input_cilindrada").value = document.getElementById("cilindrada_result").innerText;
            document.getElementById("input_ano_fabrico").value = document.getElementById("ano_result").innerText;
            document.getElementById("input_data_inicio").value = document.getElementById("data_result").innerText;
            document.getElementById("input_id_categoria").value = document.getElementById("categoria_result").innerText;
            document.getElementById("input_premio_rc_legal").value = document.getElementById("rc_legal").innerText;
            document.getElementById("input_premio_comercial_rc").value = document.getElementById("comercial_rc").innerText;
            document.getElementById("input_campanha_id").value = id_campanha_selecionada;

            // Mostrar tela de loading
            const loadingOverlay = document.createElement('div');
            loadingOverlay.innerHTML = `
            <div id="loading-overlay" class="loading-container">
                <div class="loading-animation">
                    <div class="car">
                    <div class="car-body">
                        <div class="car-top"></div>
                        <div class="car-bottom"></div>
                        <div class="car-light"></div>
                    </div>
                    <div class="wheel wheel-left">
                        <div class="wheel-inner"></div>
                    </div>
                    <div class="wheel wheel-right">
                        <div class="wheel-inner"></div>
                    </div>
                    </div>
                    <div class="road">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                    <div class="line line-3"></div>
                    <div class="line line-4"></div>
                    </div>
                    <div class="shield">
                    <div class="shield-icon"></div>
                    </div>
                </div>
                <div class="status-text" id="status-message">Processando sua simulação de seguro...</div>
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
            </div>`;
            document.body.appendChild(loadingOverlay);

            // Adicione os estilos para o loading
            const styleElement = document.createElement('style');
            styleElement.textContent = 
            `
                .loading-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 30, 0.9);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                font-family: 'Arial', sans-serif;
                }
                
                .loading-animation {
                position: relative;
                width: 300px;
                height: 200px;
                }
            
                /* Estilo do carro */
                .car {
                position: absolute;
                width: 120px;
                height: 50px;
                top: 100px;
                left: 90px;
                z-index: 10;
                animation: carBounce 1s infinite ease-in-out;
                }
                
                .car-body {
                position: absolute;
                width: 100%;
                height: 100%;
                background: #00af9e;
                border-radius: 12px;
                }
            
                .car-top {
                position: absolute;
                top: -20px;
                left: 25px;
                width: 70px;
                height: 22px;
                background: #00af9e;
                border-radius: 10px 10px 0 0;
                }
                
                .car-bottom {
                position: absolute;
                bottom: -5px;
                width: 100%;
                height: 10px;
                background: #0090a0;
                border-radius: 0 0 5px 5px;
                }
            
                .car-light {
                position: absolute;
                top: 10px;
                right: 5px;
                width: 10px;
                height: 6px;
                background: #ffdd59;
                border-radius: 3px;
                box-shadow: 0 0 10px 2px rgba(255, 221, 89, 0.6);
                animation: lightFlash 1s infinite;
                }
            
                /* Estilo das rodas */
                .wheel {
                position: absolute;
                width: 26px;
                height: 26px;
                bottom: -13px;
                background: #333;
                border-radius: 50%;
                animation: wheelRotate 2s infinite linear;
                }
                
                .wheel-left {
                left: 15px;
                }
            
                .wheel-right {
                right: 15px;
                }
                
                .wheel-inner {
                position: absolute;
                width: 12px;
                height: 12px;
                top: 7px;
                left: 7px;
                background: #666;
                border-radius: 50%;
                }
            
                /* Estilo da estrada */
                .road {
                position: absolute;
                width: 300px;
                height: 10px;
                bottom: 50px;
                background: #333;
                border-radius: 3px;
                }
                
                .line {
                position: absolute;
                height: 4px;
                width: 30px;
                background: #fff;
                top: 3px;
                animation: lineMove 1.5s infinite linear;
                }
            
                .line-1 { left: 30px; animation-delay: 0s; }
                .line-2 { left: 100px; animation-delay: 0.3s; }
                .line-3 { left: 170px; animation-delay: 0.6s; }
                .line-4 { left: 240px; animation-delay: 0.9s; }
                
                /* Estilo do escudo (símbolo de seguro) */
                .shield {
                position: absolute;
                width: 40px;
                height: 50px;
                top: 30px;
                left: 130px;
                background: rgba(0, 175, 158, 0.3);
                border: 2px solid #00af9e;
                border-radius: 50% 50% 0 50%;
                transform: rotate(45deg);
                animation: shieldPulse 2s infinite;
                }
            
                .shield-icon {
                position: absolute;
                top: 12px;
                left: 12px;
                width: 16px;
                height: 16px;
                border-right: 3px solid #fff;
                border-bottom: 3px solid #fff;
                transform: rotate(45deg);
                }
                
                /* Barra de progresso e texto */
                .status-text {
                color: white;
                font-size: 20px;
                text-align: center;
                margin-top: 30px;
                margin-bottom: 20px;
                }
            
                .progress-container {
                width: 300px;
                height: 8px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 10px;
                overflow: hidden;
                }
                
                .progress-bar {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, #00af9e, #00e5cc);
                border-radius: 10px;
                transition: width 0.5s ease;
                }
            
                /* Animações */
                @keyframes carBounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-3px); }
                }
                
                @keyframes wheelRotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
                }
                
                @keyframes lineMove {
                0% { opacity: 0; transform: translateX(50px); }
                50% { opacity: 1; }
                100% { opacity: 0; transform: translateX(-50px); }
                }
                
                @keyframes lightFlash {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
                }
                
                @keyframes shieldPulse {
                0%, 100% { opacity: 0.7; transform: rotate(45deg) scale(1); }
                50% { opacity: 1; transform: rotate(45deg) scale(1.1); }
                }
            `;
            document.head.appendChild(styleElement);

            const messages = [
                "Processando sua simulação de seguro...",
                "Calculando coberturas ideais...",
                "Analisando perfil de risco...",
                "Preparando documento de cotação...",
                "Configurando proteção personalizada...",
                "Finalizando sua simulação de seguro..."
            ];

            let progress = 0;
            let messageIndex = 0;
            const progressBar = document.getElementById('progress-bar');
            const statusMessage = document.getElementById('status-message');

            const progressInterval = setInterval(() => {
                progress += 1;
                progressBar.style.width = `${progress}%`;
                if (progress % 20 === 0 && messageIndex < messages.length - 1) {
                    messageIndex++;
                    statusMessage.textContent = messages[messageIndex];
                }

                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, 30);

            const formData = new FormData(this);

            fetch("home/create", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Dados enviados com sucesso!");
                        setTimeout(() => {
                            document.body.removeChild(loadingOverlay);
                            document.head.removeChild(styleElement);
                            window.open(data.redirectUrl, '_blank');
                            urlredirect = data.redirectUrl;
                        }, 2000);
                    } else {
                        document.body.removeChild(loadingOverlay);
                        document.head.removeChild(styleElement);
                        alert(data.message || "Ocorreu um erro desconhecido.");
                    }
                })
                .catch(error => {
                    console.error("Erro ao enviar dados:", error);
                    document.body.removeChild(loadingOverlay);
                    document.head.removeChild(styleElement);
                    alert("Ocorreu um erro ao enviar a simulação.");
                });
        });

        function baixarPdf() {
            window.open(urlredirect, '_blank');
        }
    </script>

    <script>
        document.addEventListener('change', function(event) {
            const input = event.target;

            if (
                input.matches('input[type="radio"][name="vehicle"]') ||
                input.matches('input[type="radio"][name="auto-categoria"]')
            ) {
                console.log('Selecionado:', input.name, input.value);
                moveToNextStep();
            }
        });

        function moveToNextStep() {
            const nextBtn = document.querySelector('.next-step');
            if (nextBtn) {
                console.log('Avançando para o próximo step...');
                nextBtn.click();
            } else {
                console.warn('Botão .next-step não encontrado!');
            }
        }

        function moveToNextStepCampanha(radio) {
            const valorSelecionado = radio.value;
            id_campanha_selecionada = radio.id; // Define o ID da campanha selecionada
            console.log("Campanha selecionada:", valorSelecionado);
            console.log("Id selecionado:", radio.id);

            const next = document.querySelector('.next-step');
            if (next) {
                next.click();
            }
        }
    </script>
</body>

</html>