<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CrawlerResult;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class BitcointalkCrawlerCommand extends Command
{
    protected $signature = 'crawler:bitcointalk {years?}';
    protected $description = 'Crawler para coletar chaves privadas de Bitcoin de posts no Bitcointalk entre 2009 e 2013';
    
    public function handle()
    {
        $years = $this->argument('years') ?? '2009,2010,2011,2012,2013';
        $yearsArray = explode(',', $years);

        foreach ($yearsArray as $year) {
            $this->info("Coletando dados do Bitcointalk no ano de $year...");
            $this->crawlBitcointalk($year);
        }
    }

    public function crawlBitcointalk($year)
    {
        $url = "https://bitcointalk.org/index.php?action=search;search=private+key;board=1.0;sort=last_msg;desc;start=0";

        $client = new Client();
        $crawler = $client->request('GET', $url);

        // Ajuste a lógica de acordo com a estrutura HTML da página
        $crawler->filter('table[class="findresults"] tr')->each(function ($node) use ($year) {
            $title = $node->filter('td.subject a')->text();
            $link = $node->filter('td.subject a')->link();

            // Verifique se o título ou conteúdo tem a chave privada
            if ($this->extractData($title)) {
                CrawlerResult::create([
                    'regex_match' => $title,
                    'found_at' => $link->getUri(),
                ]);
                $this->info("Correspondência encontrada e salva: $title");
            }
        });
    }

    public function extractData($data)
    {
        $regex = '/(5[HJK][1-9A-Za-z]{49}|[KL][1-9A-HJ-NP-Za-km-z]{51}|[123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]{51,52})/';

        return preg_match($regex, $data);
    }
}
