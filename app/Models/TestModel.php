<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{

    protected $table = 'phones'; // definindo o nome da tabela a ser usada pelo model.

    protected $primaryKey = 'id'; // definindo qual coluna é a chave primária.

    public $incrementing = false; // desativa o autoincrement padrão do laravel, para usar strings ou uuids.

    protected $keyType = 'string'; // diz que o tipo da chave é string o default do laravel é inteiro.

    public $timestamps = false; // indica que a tabela não tem as colunas de updated_at e created_at.

    protected $dateFormat = 'Y-m-d H:i:s'; // mudando o formato da data e hora no timestamps.


    // indicando que os timestamps tem nomes de colunas diferentes
    const CREATED_AT = 'criado em';
    const UPDATED_AT = 'atualizado em';


    protected $connection = 'mysql'; // caso use mais de uma base, pode definir a qual banco deve pegar informações
}
