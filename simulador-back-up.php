<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="public/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/pizzip@3.1.8/dist/pizzip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/docxtemplater@3.60.1/build/docxtemplater.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <style>
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
            background-color: #1e272e;
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
            overflow-y: auto;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 100;
            display: none;
            margin-top: 5px;
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
        /**  */
        /**  */

        /* see end */
    </style>
</head>

<body>

    <section class="hero" id="home">
        <div id="particles"></div>
        <h1>Simuladores Tranquilidade</h1>
        <p>Descubra o melhor seguro para você com nossos simuladores inteligentes. Tecnologia avançada para proteger o
            que importa.</p>
        <button class="cta-button" id="start-simulator">Simular Agora</button>
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
                    <button class="cta-button step-button next-step">Próximo</button>
                </div>

                <div class="step-2 step-container" id="step2">
                    <div class="form-group">
                        <div class="container1" id="radiobtnCategory">
                        </div>
                    </div>

                    <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button step-button next-step">Próximo</button>
                </div>

                <div class="step-3 step-container" id="step3">
                    <div class="form-group">

                    </div>

                    <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button step-button next-step">Próximo</button>
                </div>

                <div class="step-4 step-container" id="step4">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="auto-matricula">Matricula</label>
                            <input type="text" id="auto-matricula" placeholder="Ex: LD-00-00">
                        </div>
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
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="auto-modelo">Modelo</label>
                            <input type="text" id="auto-modelo" placeholder="Modelo do Veículo">
                        </div>
                        <div class="form-group">
                            <label for="auto-cilindrada">Cilindrada</label>
                            <input type="text" id="auto-cilindrada" placeholder="Cilindrada do Veículo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="auto-year">Ano do Veículo</label>
                            <input type="text" id="auto-year" pattern="\d{4}" placeholder="AAAA" title="Insira um ano de 4 dígitos">
                            <!-- <select id="auto-year">
                                <option value="">Selecione</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                            </select> -->
                        </div>
                        <div class="form-group">
                            <label for="auto-data">Data de Início</label>
                            <input type="date" id="auto-data" placeholder="Data">
                        </div>
                    </div>

                    <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button step-button next-step">Próximo</button>
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
                        <span class="error-message">Por favor, preencha um NIF válido (9 dígitos).</span>
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
                    <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button step-button next-step">Próximo</button>
                </div>

                <div class="step-6 step-container" id="step6">
                    <button class="cta-button step-button prev-step">Anterior</button>
                    <button class="cta-button" id="calculate-auto">Calcular</button>
                    <div class="result-container" id="auto-result">
                        <!--  -->
                        <!--  -->
                        <div id="cotation-pdf"></div>
                        <!--  -->
                        <!--  -->
                        <div>
                            <h4>Dados do Cliente</h4>
                            <div class="result-detail">
                                <span class="result-label">Nome:</span>
                                <span class="result-value" id="nome_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Email:</span>
                                <span class="result-value" id="email_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">NIF:</span>
                                <span class="result-value" id="nif_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Contato:</span>
                                <span class="result-value" id="contato_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Endereço:</span>
                                <span class="result-value" id="endereco_result"></span>
                            </div>
                        </div>

                        <div>
                            <h4>Dados do Automovél</h4>
                            <div class="result-detail">
                                <span class="result-label">Matricula:</span>
                                <span class="result-value" id="matricula_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Marca:</span>
                                <span class="result-value" id="marca_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Modelo:</span>
                                <span class="result-value" id="modelo_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Cilindrada:</span>
                                <span class="result-value" id="cilindrada_result"></span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Ano de fabrico:</span>
                                <span class="result-value" id="ano_result"></span>
                            </div>

                            <div class="result-detail">
                                <span class="result-label">Data de inicio:</span>
                                <span class="result-value" id="data_result"></span>
                            </div>

                            <div class="result-detail">
                                <span class="result-label">Categoria:</span>
                                <span class="result-value" id="categoria_result"></span>
                            </div>
                        </div>

                        <div>
                            <h4>Resultado da Simulação</h4>
                            <div class="result-detail">
                                <span class="result-label">Prêmio RC Legal:</span>
                                <span class="result-value" id="rc_legal">AOA 0,00</span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Prêmio Comercial RC:</span>
                                <span class="result-value" id="comercial_rc">AOA 0,00</span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Prêmio POC:</span>
                                <span class="result-value" id="premio_poc">AOA 0,00</span>
                            </div>
                            <div class="result-detail">
                                <span class="result-label">Prêmio QIV:</span>
                                <span class="result-value" id="premio_qiv">AOA 0,00</span>
                            </div>
                            <!-- <div class="result-detail">
                                <span class="result-label">Total Mensal:</span>
                                <span class="result-value total-value" id="monthly-total">AOA 0,00</span>
                            </div> -->
                            <button id="download-word" class="cta-button">Imprimir a Simulação</button>
                        </div>
                    </div>
                </div>
                <button class="back-button">Voltar</button>
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/docx@9.2.0/+esm"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> -->

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
        document.getElementById('data').min = dataMinima;
        document.getElementById('data').value = dataMinima; // Define a data de amanhã como valor padrão

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

                const div = document.createElement("div");
                div.className = "radio-label";
                div.style.width = "auto";

                const img = document.createElement("img");
                img.src = "https://cdn-icons-png.flaticon.com/128/189/189235.png";
                img.alt = optionData.nome;

                const span = document.createElement("span");
                span.textContent = optionData.nome;

                div.appendChild(img);
                div.appendChild(span);
                label.appendChild(input);
                label.appendChild(div);
                radiobtnCategory.appendChild(label);
            });
        }
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
                        alert('Formulário enviado com sucesso!');
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
                            const nifRegex = /^\d{9}$/;
                            if (!nifRegex.test(input.value)) {
                                showError(formGroup, errorMessage, 'O NIF deve conter 9 dígitos.');
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
                "janeiro", "fevereiro", "março", "abril", "maio", "junho",
                "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"
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
                        return; // Don't proceed if step 1 is invalid
                    }
                    if (currentStep === 2 && !validateStep('step2')) {
                        return; // Don't proceed if step 2 is invalid
                    }
                    if (currentStep === 3 && !validateStep('step3')) {
                        return; // Don't proceed if step 2 is invalid
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

            // --- Auto Calculator ---
            document.getElementById('calculate-auto').addEventListener('click', function() {
                const matricula = document.getElementById('auto-matricula').value;
                const brand = document.getElementById('auto-marca').value;
                // const categoria = document.getElementById('auto-categoria').value;

                const radios = document.getElementsByName('auto-categoria');
                let categoria;

                for (const radio of radios) {
                    if (radio.checked) {
                        categoria = radio.value;
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

                console.log(linhaCategoria)

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

                /*Resultado simulação*/
                // rc_legal: formatNumber((0.875 * moto100 * cambio) + (0.875 * moto100 * cambio * iva) + (0.875 * moto100 * cambio * fga)),
                document.getElementById('rc_legal').textContent = formatNumber((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_rc_legal * cambio * iva) + (linhaCategoria.premio_rc_legal * cambio * fga));

                // comercial_rc: formatNumber((0.875 * moto100 * cambio) + (moto100Poc * cambio) + (((0.875 * moto100 * cambio) + (moto100Poc * cambio)) * iva) + (((0.875 * moto100 * cambio) + (moto100Poc * cambio)) * fga)),
                document.getElementById('comercial_rc').textContent = formatNumber(
                    (linhaCategoria.premio_rc_legal * cambio) +
                    (linhaCategoria.premio_poc * cambio) +
                    (
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * iva +
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * fga
                    )
                );
                // document.getElementById('rc_legal').textContent = dados[categoria].rc_legal;
                // document.getElementById('comercial_rc').textContent = dados[categoria].comercial_rc;
                // document.getElementById('premio_poc').textContent = dados[categoria].premio_poc;
                // document.getElementById('premio_qiv').textContent = dados[categoria].premio_qiv;
                // document.getElementById('monthly-total').textContent = 'formatCurrency(monthlyTotal)';

                const select = document.getElementById('auto-categoria');
                // const categoriaTexto = select.options[select.selectedIndex].text;
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
                    // premio_poc: document.getElementById('premio_poc').textContent,
                    // premio_qiv: document.getElementById('premio_qiv').textContent,
                    data_actual: dataFormatada
                };

                // gerarWord(Totaldados);
                // gerarPDF(Totaldados);

                showResults('auto-result');
            });

            // Função para gerar um documento Word
            async function gerarWord(dados) {
                // Carregar o arquivo template.docx
                const response = await fetch("template.docx");
                const arrayBuffer = await response.arrayBuffer();

                const zip = new PizZip(arrayBuffer);
                const doc = new window.docxtemplater().loadZip(zip);

                // Substituir os placeholders
                doc.setData(dados);
                doc.render();

                // Gerar o documento final
                const output = doc.getZip().generate({
                    type: "blob"
                });
                saveAs(output, "Simulacao_Seguro_Auto.docx");
            }

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

        function gerarPDF(dados) {
            const nome = 'simoa';
            const idade = 29;

            console.log('simao')
            console.log(dados)

            // Atualiza o conteúdo HTML para o PDF
            const conteudo = document.getElementById('cotation-pdf');
            conteudo.innerHTML = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Proposta de Cotação de Seguro de Automóvel</title>
    <style>
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
            background-image: linear-gradient(
                to bottom,
                #4D9F50 0px, #4D9F50 8px,
                #0A8754 8px, #0A8754 16px,
                #00A786 16px, #00A786 24px,
                #00C0A0 24px, #00C0A0 32px,
                #00D5B2 32px, #00D5B2 40px
            );
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
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
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
    </style>
</head>
<body>
    <!-- Página de Capa -->
    <div class="capa">
        <div class="logo">
            <span style="color: #4D9F50; font-size: 24px; font-weight: bold;">TRAN</span><br>
            <span style="color: #0A8754; font-size: 24px; font-weight: bold;">QUILI</span><br>
            <span style="color: #00A786; font-size: 24px; font-weight: bold;">DADE</span>
        </div>
        
        <div class="faixas-verdes"></div>
        
        <div class="texto-capa">
            <h1>PROPOSTA DE COTAÇÃO DE SEGURO DE</h1>
            <h2>AUTOMÓVEL</h2>
            <h3>Opção VALOR</h3>
        </div>
        
        <div class="contatos">
            <span>📞 +555 197 555</span>
            <span>💬 seguro@tranquilidade.co.ao</span>
            <span>🌐 tranquilidade.ao</span>
        </div>
        
        <div class="rodape-capa">
            <div class="redes-sociais">
                <span style="color: white; font-size: 14px;">f in 📷</span>
            </div>
        </div>
    </div>
    
    <!-- Quebra de página após a capa -->
    <div class="page-break"></div>
    
    <!-- Páginas de conteúdo -->
    <div class="content-page">
        <div class="header">
            <h1>Simulação</h1>
            <h2>Seguro Automóvel</h2>
        </div>
        
        <div class="data-cotacao">
            <div class="row">
                <div class="col">
                    <span class="label">Data</span>
                    <span class="value">${dados.nome}</span>
                </div>
                <div class="col">
                    <span class="label">Cotação nº</span>
                    <span class="value">${dados.nome}</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>1. TOMADOR DE SEGURO / SEGURADO</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Nome</span>
                    <span class="value">${dados.nome}</span>
                </div>
                <div class="col">
                    <span class="label">Contacto</span>
                    <span class="value">${dados.contato}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Morada</span>
                    <span class="value">${dados.endereco}</span>
                </div>
                <div class="col">
                    <span class="label">E-mail</span>
                    <span class="value">${dados.email}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">NIF</span>
                    <span class="value">${dados.nif}</span>
                </div>
                <div class="col">
                    <span class="label">Modalidade</span>
                    <span class="value">${dadosmodalidade}</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>2. PERÍODO SEGURO</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Prêmio</span>
                    <span class="value">' . $dados['premio'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Data de Início</span>
                    <span class="value">' . $dados['dataInicio'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Data de Vencimento</span>
                    <span class="value">' . $dados['dataVencimento'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>3. VIATURA(S) SEGURA(S)</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Categoria</span>
                    <span class="value">' . $dados['categoria'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Matrícula</span>
                    <span class="value">' . $dados['matricula'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Marca</span>
                    <span class="value">' . $dados['marca'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Modelo</span>
                    <span class="value">' . $dados['modelo'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Cilindrada (cc)</span>
                    <span class="value">' . $dados['cilindrada'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Ano de Fabrico</span>
                    <span class="value">' . $dados['anoFabrico'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>4. COBERTURAS / CAPITAIS / FRANQUIAS</h2>
            
            <table>
                <tr>
                    <th colspan="3">Opção ESSENCIAL (só RC)</th>
                </tr>
                <tr>
                    <td>RC - Responsabilidade Civil</td>
                    <td>Capital</td>
                    <td>Conforme decreto de 35/09 de 11 de agosto</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
            </table>
            
            <br>
            
            <table>
                <tr>
                    <th colspan="3">Opção ESSENCIAL PLUS (RC + POC)</th>
                </tr>
                <tr>
                    <td>RC - Responsabilidade Civil</td>
                    <td>Capital</td>
                    <td>Conforme decreto de 35/09 de 11 de agosto</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
                <tr>
                    <td>POC - Protecção de Ocupantes</td>
                    <td>Capital</td>
                    <td>Conforme capitais próprios da cobertura (*)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
            </table>
            
            <br>
            
            <table>
                <tr>
                    <th colspan="2">(*) Capitais POC</th>
                    <th>AOA</th>
                </tr>
                <tr>
                    <td colspan="2">Morte</td>
                    <td>2.500.000,00</td>
                </tr>
                <tr>
                    <td colspan="2">Despesas de Tratamento / Ocupantes</td>
                    <td>375.000,00</td>
                </tr>
                <tr>
                    <td colspan="2">Despesas de Tratamento / Condutor</td>
                    <td>500.000,00</td>
                </tr>
            </table>
            
            <p>Em caso de colocação, deve ser partilhada cópia da documentação oficial da viatura.</p>
            <p>Condições exclusivamente para viaturas de utilização particular, isto é, não abrange viaturas de aluguer.</p>
        </div>
        
        <div class="info-box">
            <h2>5. EXCLUSÕES</h2>
            <p>Aplicáveis as exclusões previstas nas Condições Gerais do Seguro Automóvel da Seguradora.</p>
            <p>Exclusão absoluta da circulação em zonas aeroportuárias de acesso restrito.</p>
        </div>
        
        <div class="info-box">
            <h2>6. FRACIONAMENTO</h2>
            <table>
                <tr>
                    <th>TOTAL (1)(2)(3)</th>
                    <th>AOA</th>
                </tr>
                <tr>
                    <td>Opção ESSENCIAL (RC)</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção ESSENCIAL PLUS (RC+POC)</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção VALOR PLUS (RC legal + QIV + POC + DP (2%))</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção VALOR PLUS RC legal + POC + DP (4%)</td>
                    <td></td>
                </tr>
            </table>
            
            <p>(1) Prémio Total Anual (em Kwanzas)</p>
            <p>(2) Modalidade de Pagamento: Anual, sem possibilidade de fraccionamento.</p>
            <p>(3) Os valores incluem IVA à taxa legal em vigor e todos os custos/encargos aplicáveis.</p>
        </div>
        
        <div class="info-box">
            <h2>7. CLAUSULADO APLICÁVEL</h2>
            <!-- Adicione aqui o conteúdo do clausulado se necessário -->
        </div>
        
        <div class="footer">
            <p>Este documento é apenas uma simulação e não constitui uma apólice de seguro.</p>
        </div>
    </div>
</body>
</html>`;

            // Gera o PDF a partir do conteúdo HTML
            html2pdf().from(conteudo).save();
        }
    </script>

</body>

</html>