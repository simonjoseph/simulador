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