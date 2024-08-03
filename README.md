# Weather Info for WordPress Plugin

## Descrição
Este plugin adiciona campos de endereço ao formulário de perfil do usuário no WordPress e utiliza a API da OpenWeatherMap para fornecer informações climáticas com base na localização do usuário.

## Requisitos
- WordPress
- API Key da OpenWeatherMap (obtenha uma [aqui](https://home.openweathermap.org/users/sign_up))

## Instalação

1. **Clone o repositório do plugin:**
   ```bash
   git clone https://github.com/luizreimann/Weather-Info-for-WordPress.git
   ```

2. **Faça o upload do plugin para o WordPress:**
   - No WordPress Admin, vá para **Plugins > Adicionar Novo > Fazer Upload de Plugin** e faça o upload do plugin.
   - Ative o plugin após o upload.

3. **Configure a API Key:**
   - No WordPress Admin, vá para **Weather Info**.
   - Adicione sua API Key da OpenWeatherMap.

## Funcionalidades

- Adiciona campos de endereço (CEP, Endereço, Número, Bairro, Cidade, Estado, Latitude, Longitude) ao formulário de registro e perfil do usuário.
- Utiliza a API da OpenWeatherMap para fornecer informações climáticas com base na localização do usuário.
- Utiliza as APIs da Brasil API e Nominatim para fornecer endereço sob demanda e coordenadas geográficas, respectivamente.
- Registra logs de todas as atividades do plugin.

## Uso

- **Configuração do plugin:**
  - Acesse **Weather Info Plugin** para configurar a API Key.

- **Visualização do log:**
  - Acesse **Weather Info Plugin** para visualizar o log de todas as consultas realizadas na API OpenWeatherMap.

- **Adição de campos de endereço:**
  - Os campos são adicionados automaticamente ao formulário de registro e perfil do usuário.

- **Consulta de endereço e coordenadas:**
  - Ao preencher o campo **CEP**, os demais campos de endereço e coordenadas (este oculto) são preenchidos automaticamente.

## Licença
Este projeto está licenciado sob a licença GPL v3. Veja o arquivo `LICENSE` para mais detalhes.