<?php



try {



    $user = 'dbagenddevpost';
    $pwd = 'Sge@4@5';
    $db = 'dbagenddevpost';
    $host = 'dbagenddevpost.postgresql.dbaas.com.br';
    $port = '5432';


    // String de conexão DSN (Data Source Name)
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";

    // Cria a instância PDO
    $pdo = new PDO($dsn, $user, $pwd);

    // Define o modo de erro para lançar exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão com o banco de dados PostgreSQL estabelecida com sucesso!";
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem
    echo "Erro na conexão: " . $e->getMessage();
    die(); // Encerra o script se houver erro na conexão
}
