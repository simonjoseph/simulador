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
                const categoria = document.getElementById('auto-categoria').value;

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
                const cambio = 853.629;
                const iva = 14.00 / 100;
                const fga = 5.00 / 100;

                const moto100 = 27.50
                const moto500 = 32.50
                const moto500plus = 42.50
                const ligeiro1600 = 45.00
                const ligeiro2500 = 50.00
                const ligeiro2500plus = 57.50
                const misto1500 = 60.00
                const misto1500plus = 65.00
                const misto2500plus = 72.50
                const Camionetas = 95.00
                const Camiao10T = 110.00
                const Camiao10Tplus = 150.00
                const Atrelado3600 = 30.00
                const Atrelado3600plus = 40.00

                const moto100Poc = 0
                const moto500Poc = 0
                const moto500plusPoc = 0
                const ligeiro1600Poc = 5.00
                const ligeiro2500Poc = 5.00
                const ligeiro2500plusPoc = 5.00
                const misto1500Poc = 7.50
                const misto1500plusPoc = 7.50
                const misto2500plusPoc = 7.50
                const CamionetasPoc = 10.00
                const Camiao10TPoc = 10.00
                const Camiao10TplusPoc = 10.00
                const Atrelado3600Poc = 0
                const Atrelado3600plusPoc = 0

                // Função para arredondar e formatar para duas casas decimais
                const formatNumber = (num) => {
                    return (Math.round(num * 100) / 100).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                };

                const dados = {
                    moto100: {
                        rc_legal: formatNumber((0.875 * moto100 * cambio) + (0.875 * moto100 * cambio * iva) + (0.875 * moto100 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * moto100 * cambio) + (moto100Poc * cambio) + (((0.875 * moto100 * cambio) + (moto100Poc * cambio)) * iva) + (((0.875 * moto100 * cambio) + (moto100Poc * cambio)) * fga)),
                        premio_poc: formatNumber(0),
                        premio_qiv: formatNumber(0)
                    },
                    moto500: {
                        rc_legal: formatNumber((0.875 * moto500 * cambio) + (0.875 * moto500 * cambio * iva) + (0.875 * moto500 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * moto500 * cambio) + (moto500Poc * cambio) + (((0.875 * moto500 * cambio) + (moto500Poc * cambio)) * iva) + (((0.875 * moto500 * cambio) + (moto500Poc * cambio)) * fga)),
                        premio_poc: formatNumber(0),
                        premio_qiv: formatNumber(0)
                    },
                    moto500plus: {
                        rc_legal: formatNumber((0.875 * moto500plus * cambio) + (0.875 * moto500plus * cambio * iva) + (0.875 * moto500plus * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * moto500plus * cambio) + (moto500plusPoc * cambio) + (((0.875 * moto500plus * cambio) + (moto500plusPoc * cambio)) * iva) + (((0.875 * moto500plus * cambio) + (moto500plusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(0),
                        premio_qiv: formatNumber(0)
                    },
                    ligeiro1600: {
                        rc_legal: formatNumber((0.875 * ligeiro1600 * cambio) + (0.875 * ligeiro1600 * cambio * iva) + (0.875 * ligeiro1600 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * ligeiro1600 * cambio) + (ligeiro1600Poc * cambio) + (((0.875 * ligeiro1600 * cambio) + (ligeiro1600Poc * cambio)) * iva) + (((0.875 * ligeiro1600 * cambio) + (ligeiro1600Poc * cambio)) * fga)),
                        premio_poc: formatNumber(5.00 * cambio),
                        premio_qiv: formatNumber(3.50 * cambio)
                    },
                    ligeiro2500: {
                        rc_legal: formatNumber((0.875 * ligeiro2500 * cambio) + (0.875 * ligeiro2500 * cambio * iva) + (0.875 * ligeiro2500 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * ligeiro2500 * cambio) + (ligeiro2500Poc * cambio) + (((0.875 * ligeiro2500 * cambio) + (ligeiro2500Poc * cambio)) * iva) + (((0.875 * ligeiro2500 * cambio) + (ligeiro2500Poc * cambio)) * fga)),
                        premio_poc: formatNumber(5.00 * cambio),
                        premio_qiv: formatNumber(3.50 * cambio)
                    },
                    ligeiro2500plus: {
                        rc_legal: formatNumber((0.875 * ligeiro2500plus * cambio) + (0.875 * ligeiro2500plus * cambio * iva) + (0.875 * ligeiro2500plus * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * ligeiro2500plus * cambio) + (ligeiro2500plusPoc * cambio) + (((0.875 * ligeiro2500plus * cambio) + (ligeiro2500plusPoc * cambio)) * iva) + (((0.875 * ligeiro2500plus * cambio) + (ligeiro2500plusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(5.00 * cambio),
                        premio_qiv: formatNumber(3.50 * cambio)
                    },
                    misto1500: {
                        rc_legal: formatNumber((0.875 * misto1500 * cambio) + (0.875 * misto1500 * cambio * iva) + (0.875 * misto1500 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * misto1500 * cambio) + (misto1500Poc * cambio) + (((0.875 * misto1500 * cambio) + (misto1500Poc * cambio)) * iva) + (((0.875 * misto1500 * cambio) + (misto1500Poc * cambio)) * fga)),
                        premio_poc: formatNumber(7.50 * cambio),
                        premio_qiv: formatNumber(6.50 * cambio)
                    },
                    misto1500plus: {
                        rc_legal: formatNumber((0.875 * misto1500plus * cambio) + (0.875 * misto1500plus * cambio * iva) + (0.875 * misto1500plus * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * misto1500plus * cambio) + (misto1500plusPoc * cambio) + (((0.875 * misto1500plus * cambio) + (misto1500plusPoc * cambio)) * iva) + (((0.875 * misto1500plus * cambio) + (misto1500plusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(7.50 * cambio),
                        premio_qiv: formatNumber(6.50 * cambio)
                    },
                    misto2500plus: {
                        rc_legal: formatNumber((0.875 * misto2500plus * cambio + (0.875 * misto2500plus * cambio * iva) + (0.875 * misto2500plus * cambio * fga))),
                        comercial_rc: formatNumber((0.875 * misto2500plus * cambio) + (misto2500plusPoc * cambio) + (((0.875 * misto2500plus * cambio) + (misto2500plusPoc * cambio)) * iva) + (((0.875 * misto2500plus * cambio) + (misto2500plusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(7.50 * cambio),
                        premio_qiv: formatNumber(6.50 * cambio)
                    },
                    Camionetas: {
                        rc_legal: formatNumber((0.875 * Camionetas * cambio) + (0.875 * Camionetas * cambio * iva) + (0.875 * Camionetas * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * Camionetas * cambio) + (CamionetasPoc * cambio) + (((0.875 * Camionetas * cambio) + (CamionetasPoc * cambio)) * iva) + (((0.875 * Camionetas * cambio) + (CamionetasPoc * cambio)) * fga)),
                        premio_poc: formatNumber(10.0 * cambio),
                        premio_qiv: formatNumber(8.50 * cambio)
                    },
                    Camiao10T: {
                        rc_legal: formatNumber((0.875 * Camiao10T * cambio) + (0.875 * Camiao10T * cambio * iva) + (0.875 * Camiao10T * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * Camiao10T * cambio) + (Camiao10TPoc * cambio) + (((0.875 * Camiao10T * cambio) + (Camiao10TPoc * cambio)) * iva) + (((0.875 * Camiao10T * cambio) + (Camiao10TPoc * cambio)) * fga)),
                        premio_poc: formatNumber(10.0 * cambio),
                        premio_qiv: formatNumber(8.50 * cambio)
                    },
                    Camiao10Tplus: {
                        rc_legal: formatNumber((0.875 * Camiao10Tplus * cambio) + (0.875 * Camiao10Tplus * cambio * iva) + (0.875 * Camiao10Tplus * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * Camiao10Tplus * cambio) + (Camiao10TplusPoc * cambio) + (((0.875 * Camiao10Tplus * cambio) + (Camiao10TplusPoc * cambio)) * iva) + (((0.875 * Camiao10Tplus * cambio) + (Camiao10TplusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(10.00 * cambio),
                        premio_qiv: formatNumber(8.50 * cambio)
                    },
                    Atrelado3600: {
                        rc_legal: formatNumber((0.875 * Atrelado3600 * cambio) + (0.875 * Atrelado3600 * cambio * iva) + (0.875 * Atrelado3600 * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * Atrelado3600 * cambio) + (Atrelado3600Poc * cambio) + (((0.875 * Atrelado3600 * cambio) + (Atrelado3600Poc * cambio)) * iva) + (((0.875 * Atrelado3600 * cambio) + (Atrelado3600Poc * cambio)) * fga)),
                        premio_poc: formatNumber(0),
                        premio_qiv: formatNumber(0)
                    },
                    Atrelado3600plus: {
                        rc_legal: formatNumber((0.875 * Atrelado3600plus * cambio) + (0.875 * Atrelado3600plus * cambio * iva) + (0.875 * Atrelado3600plus * cambio * fga)),
                        comercial_rc: formatNumber((0.875 * Atrelado3600plus * cambio) + (Atrelado3600plusPoc * cambio) + (((0.875 * Atrelado3600plus * cambio) + (Atrelado3600plusPoc * cambio)) * iva) + (((0.875 * Atrelado3600plus * cambio) + (Atrelado3600plusPoc * cambio)) * fga)),
                        premio_poc: formatNumber(0),
                        premio_qiv: formatNumber(0)
                    }
                };

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
                document.getElementById('rc_legal').textContent = dados[categoria].rc_legal;
                document.getElementById('comercial_rc').textContent = dados[categoria].comercial_rc;
                document.getElementById('premio_poc').textContent = dados[categoria].premio_poc;
                document.getElementById('premio_qiv').textContent = dados[categoria].premio_qiv;
                // document.getElementById('monthly-total').textContent = 'formatCurrency(monthlyTotal)';

                const select = document.getElementById('auto-categoria');
                const categoriaTexto = select.options[select.selectedIndex].text;

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
                    premio_poc: document.getElementById('premio_poc').textContent,
                    premio_qiv: document.getElementById('premio_qiv').textContent,
                    data_actual: dataFormatada
                };

                gerarWord(Totaldados);
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


    </script>