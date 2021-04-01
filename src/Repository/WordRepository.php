<?php
declare(strict_types=1);
namespace App\Repository;

//this is a fake repository

class WordRepository
{

    //fui obrigado a remover os acentos manualmente pois o linux não aceita o encoding e como isso não é o foco,
    // decidi optar pelo mais fácil, ao invés de alterar as configurações da imagem docker.
    public static function load(): array
    {
        return [
            "Abacaxi", "Manada", "mandar", "porta", "mesa", "Dado", "Mangas", "Ja", "coisas",
            "radiografia", "matemática", "Drogas", "predios", "implementacao", "computador", "balao",
            "Xicara", "Tedio", "faixa", "Livro", "deixar", "superior", "Profissao", "Reuniao", "Predios",
            "Montanha", "Botanica", "Banheiro", "Caixas", "Xingamento", "Infestacao", "Cupim",
            "Premiada", "empanada", "Ratos", "Ruido", "Antecedente", "Empresa", "Emissario", "Folga",
            "Fratura", "Goiaba", "Gratuito", "Hidrico", "Homem", "Jantar", "Jogos", "Montagem",
            "Manual", "Nuvem", "Neve", "Operacao", "Ontem", "Pato", "Pe", "viagem", "Queijo", "Quarto",
            "Quintal", "Solto", "rota", "Selva", "Tatuagem", "Tigre", "Uva", "ultimo", "Vituperio",
            "Voltagem", "Zangado", "Zombaria", "Dor"
        ];

    }


    public static function getLetterPunctuation(): array
    {
        return [

                "E" => 1, "A" => 1, "I" => 1, "O" => 1, "N" => 1, "R" => 1, "T" => 1, "L" => 1, "S" => 1, "U" => 1,
                "D" => 2, "G" => 2,
                "B" => 3, "C" => 3, "M" => 3, "P" => 3,
                "F" => 5, "H" => 5, "V" => 5,
                "J" => 8, "X" => 8,
                "Q" => 13, "Z" => 13
            ];

    }

}
