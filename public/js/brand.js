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