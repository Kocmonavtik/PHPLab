<?php
try
{
    $connection = new PDO('pgsql:host=localhost;port=5435;user=postgres;password=290677;dbname=task2');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo $e->getMessage();
}

function sendBD($xml_text)
{
    global $connection;
        foreach($xml_text->books as $xml)
        {
            // Формируем запрос
            $prepared = $connection->prepare("INSERT INTO books (name, author, pagecount, country) 
                VALUES ('$xml->name', '$xml->author', '$xml->pagecount','$xml->country')");
            try
            {
                $prepared->execute();
                echo 'Данные записаны'.PHP_EOL;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage().PHP_EOL;
            }
        }
        getBD();
}
function getBD()
{
    global $connection;
    $prepared = $connection->prepare('SELECT name, author,pagecount,country from books');
    try
    {
        $prepared->execute();
        $result=$prepared->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);
        $jsonString=json_encode($result);
        file_put_contents('output.json',$jsonString);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage().PHP_EOL;
    }
}