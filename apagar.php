<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
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
                <button class="back-button">Voltar</button>
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
        });
    </script>
</body>
</html>