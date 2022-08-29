# Desafio | Backend | API REST em PHP
O desafio consistiu em usar a base de dados em SQLite disponibilizada e criar uma rota de uma API REST que liste e filtre todos os dados. Serão 13 registros sobre os quais precisamos que seja criado um filtro utilizando parâmetros na url (ex: /registros?deleted=0&type=sugestao) e retorne todos resultados filtrados em formato JSON.

deleted: Um filtro de tipo boolean. Ou seja, quando filtrado por 0 (false) deve retornar todos os registros que não foram marcados como removidos, quando filtrado por 1 (true) deve retornar todos os registros que foram marcados como removidos.
type: Categoria dos registros. Serão 3 categorias, denuncia, sugestao e duvida. Quando filtrado por um type (ex: denuncia), deve retornar somente os registros daquela categoria.

Também foi criado o método de inserir dados no mesmo banco (POST).

Para testar utilize na url ('http://localhost/teste_backend/App/registros.php'); utilizando após esse endereço os filtros pedidos.
