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