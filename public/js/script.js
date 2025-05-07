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

document.addEventListener('DOMContentLoaded', function () {
    // --- Helper Functions ---
    const formatCurrency = (value) => new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);

    const showElement = (elementId) => {
        document.getElementById(elementId).style.display = 'block';
    };

    const hideElement = (elementId) => {
        document.getElementById(elementId).style.display = 'none';
    };

    const resetResults = (resultId) => {
        const resultContainer = document.getElementById(resultId);
        if (resultContainer) {
            resultContainer.querySelectorAll('.result-value').forEach(value => {
                value.textContent = "AOA 0,00";
            });
        }
    };

    const validateStep = (stepId) => {
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
    };

    const formatNumber = (num) => (Math.round(num * 100) / 100).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    // --- Modal Functions ---
    const modal = document.getElementById('myModal');
    const openModal = () => modal.style.display = 'block';
    const closeModal = () => modal.style.display = 'none';

    document.querySelector('.close').addEventListener('click', closeModal);

    // --- Multi-Step Navigation ---
    let currentStep = 1;

    const navigateStep = (direction) => {
        const currentStepElement = document.querySelector(`.step-${currentStep}`);
        currentStepElement.classList.remove('active');
        currentStep += direction;
        const nextStepElement = document.querySelector(`.step-${currentStep}`);
        nextStepElement.classList.add('active');
    };

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            if (!validateStep(`step${currentStep}`)) return;
            navigateStep(1);
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => navigateStep(-1));
    });

    // --- Simulator Button Events ---
    document.querySelectorAll('.simulator-button').forEach(button => {
        button.addEventListener('click', function () {
            const simulatorType = this.closest('.simulator-card').dataset.type;
            openModal();
            showElement(`${simulatorType}-form`);
            hideElement(`${simulatorType}-result`);
            resetResults(`${simulatorType}-result`);
            currentStep = 1;
            document.querySelector(".step-container.active")?.classList.remove("active");
            document.getElementById("step1").classList.add("active");
        });
    });

    // --- Auto Calculator ---
    document.getElementById('calculate-auto').addEventListener('click', function () {
        const getValue = (id) => document.getElementById(id).value;
        const getCheckedValue = (name) => [...document.getElementsByName(name)].find(radio => radio.checked)?.value;

        const inputs = {
            fullName: getValue('full-name'),
            email: getValue('email'),
            nif: getValue('nif'),
            contact: getValue('contact'),
            address: getValue('address'),
            matricula: getValue('auto-matricula'),
            brand: getValue('auto-marca'),
            modelo: getValue('auto-modelo'),
            cilindrada: getValue('auto-cilindrada'),
            veiculoYear: getValue('auto-year'),
            dataInicio: getValue('auto-data'),
            categoria: getCheckedValue('auto-categoria'),
            campanha: getCheckedValue('campanha') || 0
        };

        const linhaCategoria = optionsTarifas.find(tarifa => tarifa.nome === inputs.categoria);
        const cambio = <?= htmlspecialchars($impostos["cambio"]) ?>;
        const iva = <?= htmlspecialchars($impostos["iva"]) ?> / 100;
        const fga = <?= htmlspecialchars($impostos["fga"]) ?> / 100;

        const calculatePremio = (premio, campanha) => {
            const base = premio * cambio;
            const total = base + (base * iva) + (base * fga);
            return formatNumber(total - (total * campanha));
        };

        const premioRcLegal = calculatePremio(linhaCategoria.premio_rc_legal, inputs.campanha / 100);
        const premioComercial = calculatePremio(linhaCategoria.premio_poc, inputs.campanha / 100);

        document.getElementById('rc_legal').textContent = premioRcLegal;
        document.getElementById('comercial_rc').textContent = premioComercial;

        Object.entries(inputs).forEach(([key, value]) => {
            const resultElement = document.getElementById(`${key}_result`);
            if (resultElement) resultElement.textContent = value;
        });

        showElement('auto-result');
    });

    // --- Form Submission ---
    document.getElementById("form-simulacao").addEventListener("submit", function (e) {
        e.preventDefault();

        const loadingOverlay = createLoadingOverlay();
        document.body.appendChild(loadingOverlay);

        const formData = new FormData(this);

        fetch("home/create", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => handleFormResponse(data, loadingOverlay))
            .catch(error => handleFormError(error, loadingOverlay));
    });

    const createLoadingOverlay = () => {
        const overlay = document.createElement('div');
        overlay.id = "loading-overlay";
        overlay.className = "loading-container";
        overlay.innerHTML = `
            <div class="loading-animation">
                <div class="car">
                    <div class="car-body">
                        <div class="car-top"></div>
                        <div class="car-bottom"></div>
                        <div class="car-light"></div>
                    </div>
                    <div class="wheel wheel-left"><div class="wheel-inner"></div></div>
                    <div class="wheel wheel-right"><div class="wheel-inner"></div></div>
                </div>
                <div class="road">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                    <div class="line line-3"></div>
                    <div class="line line-4"></div>
                </div>
                <div class="shield"><div class="shield-icon"></div></div>
            </div>
            <div class="status-text" id="status-message">Processando sua simulação de seguro...</div>
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar"></div>
            </div>`;
        return overlay;
    };

    const handleFormResponse = (data, overlay) => {
        document.body.removeChild(overlay);
        if (data.success) {
            window.open(data.redirectUrl, '_blank');
        } else {
            alert(data.message || "Ocorreu um erro desconhecido.");
        }
    };

    const handleFormError = (error, overlay) => {
        console.error("Erro ao enviar dados:", error);
        document.body.removeChild(overlay);
        alert("Ocorreu um erro ao enviar a simulação.");
    };
});