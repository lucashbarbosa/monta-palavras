<?php

namespace App\Repository;

//this is a fake repository

class WordRepository
{




    public static function load() :array
    {
        return  [
            "Abacaxi", "Manada", "mandar", "porta", "mesa", "Dado", "Mangas", "Já", "coisas",
            "radiografia", "matemática", "Drogas", "prédios", "implementação", "computador", "balão",
            "Xícara", "Tédio", "faixa", "Livro", "deixar", "superior", "Profissão", "Reunião", "Prédios",
            "Montanha", "Botânica", "Banheiro", "Caixas", "Xingamento", "Infestação", "Cupim",
            "Premiada", "empanada", "Ratos", "Ruído", "Antecedente", "Empresa", "Emissário", "Folga",
            "Fratura", "Goiaba", "Gratuito", "Hídrico", "Homem", "Jantar", "Jogos", "Montagem",
            "Manual", "Nuvem", "Neve", "Operação", "Ontem", "Pato", "Pé", "viagem", "Queijo", "Quarto",
            "Quintal", "Solto", "rota", "Selva", "Tatuagem", "Tigre", "Uva", "Último", "Vitupério",
            "Voltagem", "Zangado", "Zombaria", "Dor"
        ];

    }


    public static function getLetterPunctuation() :array
    {
        return [
            ["E", "A", "I", "O", "N", "R", "T", "L", "S", "U" => 1],
            ["D","G" => 2],
            ["B", "C", "M", "P" => 3],
            ["F", "H", "V" => 5 ],
            ["J", "X" => 8],
            ["Q", "Z" => 13]
        ];

    }

}