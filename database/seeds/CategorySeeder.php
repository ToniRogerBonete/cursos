<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrCreate([
            'name' =>'Administração',
        ]);
        Category::firstOrCreate([
            'name' =>'Análise e desenvolvimento',
        ]);
        Category::firstOrCreate([
            'name' =>'Arquitetura',
        ]);
        Category::firstOrCreate([
            'name' =>'Audio Visual',
        ]);
        Category::firstOrCreate([
            'name' =>'Ciências',
        ]);
        Category::firstOrCreate([
            'name' =>'Concursos',
        ]);
        Category::firstOrCreate([
            'name' =>'Consultorias',
        ]);
        Category::firstOrCreate([
            'name' =>'Criação',
        ]);
        Category::firstOrCreate([
            'name' =>'Design e criação',
        ]);
        Category::firstOrCreate([
            'name' =>'Design de produtos',
        ]);
        Category::firstOrCreate([
            'name' =>'Engenharia Civíl',
        ]);
        Category::firstOrCreate([
            'name' =>'Engenharia de produção',
        ]);
        Category::firstOrCreate([
            'name' =>'Escrita e tradução',
        ]);
        Category::firstOrCreate([
            'name' =>'Financeiro',
        ]);
        Category::firstOrCreate([
            'name' =>'Fotografia',
        ]);
        Category::firstOrCreate([
            'name' =>'Jogos',
        ]);
        Category::firstOrCreate([
            'name' =>'Matemática',
        ]);
        Category::firstOrCreate([
            'name' =>'Medicina',
        ]);
        Category::firstOrCreate([
            'name' =>'Medicina e Segurança',
        ]);
        Category::firstOrCreate([
            'name' =>'Música',
        ]);
        Category::firstOrCreate([
            'name' =>'Musica e Arte',
        ]);
        Category::firstOrCreate([
            'name' =>'Produção digital',
        ]);
        Category::firstOrCreate([
            'name' =>'Produção Indústrial',
        ]);
        Category::firstOrCreate([
            'name' =>'Religião',
        ]);
        Category::firstOrCreate([
            'name' =>'Religiao telogia',
        ]);
        Category::firstOrCreate([
            'name' =>'Serviços Empresariais',
        ]);
        Category::firstOrCreate([
            'name' =>'Suporte Administrativo',
        ]);
        Category::firstOrCreate([
            'name' =>'Tecnologia',
        ]);
        Category::firstOrCreate([
            'name' =>'Turismo',
        ]);
        Category::firstOrCreate([
            'name' =>'Vendas e Marketing',
        ]);
        Category::firstOrCreate([
            'name' =>'Web e Desenvolvimento',
        ]);
        Category::firstOrCreate([
            'name' =>'Outra categoria',
        ]);

    }
}
