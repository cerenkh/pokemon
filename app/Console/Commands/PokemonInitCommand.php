<?php

namespace App\Console\Commands;

use App\Character;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PokemonInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokemon:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert pokemon to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $client = new Client();
        $request = $client->get('https://pokeapi.co/api/v2/pokemon');
        $characters = json_decode($request->getBody()->getContents(), true);
        //

        foreach ($characters['results'] as $character) {
            $pokeApiId = explode('/', $character['url']);

            Character::create([

                'name' => $character['name'],
                'pokemon_id' => $pokeApiId[6],
                'experience' => random_int(0,100)

            ]);
            $this->line("{$character['name']} added");

        }

        $this->line('Done');

    }
}
