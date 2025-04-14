<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="public/css/style.css">

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
                            <!-- <input type="text" id="auto-cilindrada" placeholder="Cilindrada do Veículo"> -->
                            <select id="auto-cilindrada">
                                <option value="">Selecione a cilindrada do Veículo</option>
                            </select>
                            <!-- <input type="number" id="auto-cilindrada" placeholder="Informe a cilindrada" required /> -->

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
                    <form id="form-simulacao">
                        <button type="submit" class="cta-button" id="calculate-auto">Calcular</button>
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
                    </form>
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
                img.src = "https://cdn-icons-png.flaticon.com/128/189/189235.png";
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

            // --- Auto Calculator ---
            document.getElementById('calculate-auto').addEventListener('click', function() {
                const matricula = document.getElementById('auto-matricula').value;
                const brand = document.getElementById('auto-marca').value;
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
                document.getElementById('rc_legal').textContent = formatNumber((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_rc_legal * cambio * iva) + (linhaCategoria.premio_rc_legal * cambio * fga));

                document.getElementById('comercial_rc').textContent = formatNumber(
                    (linhaCategoria.premio_rc_legal * cambio) +
                    (linhaCategoria.premio_poc * cambio) +
                    (
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * iva +
                        ((linhaCategoria.premio_rc_legal * cambio) + (linhaCategoria.premio_poc * cambio)) * fga
                    )
                );

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
            styleElement.textContent = `
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
            }`;
            document.head.appendChild(styleElement);

            // Animar a barra de progresso
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
                            // window.location.href = data.redirectUrl;
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

</body>

</html>