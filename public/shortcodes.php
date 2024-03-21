<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.instagram.com/josemanuel.vega.73/
 * @since      1.0.0
 *
 * @package    Pokemones
 * @subpackage Pokemones/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pokemones
 * @subpackage Pokemones/public
 * @author     José Vega <josevega1999.16@gmail.com>
 */

// Función para el shortcode que devuelve el nombre del tipo de Pokémon

function apiSearshing($url){
    $curl=curl_init();
    //$url="https://pokeapi.co/api/v2/";
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getPokeImg($url){
    $data= json_decode(apiSearshing($url), true);
    return $data['sprites']['front_default'];
}

function obtener_nombre_tipo_pokemon($atts) {
    //if (!is_admin()) {
        // Obtener el tipo de Pokémon del atributo del shortcode
        $tipo = isset($atts['type']) ? strtolower($atts['type']) : '';
        $limit = isset($atts['limit']) ? intval($atts['limit']) : 0;

        // Array asociativo de tipos de Pokémon y sus nombres
        $tipos_pokemon = array(
            'normal' => 'https://pokeapi.co/api/v2/type/1/',
            'fighting' => 'https://pokeapi.co/api/v2/type/2/',
            'flying' => 'https://pokeapi.co/api/v2/type/3/',
            'poison' => 'https://pokeapi.co/api/v2/type/4/',
            'ground' => 'https://pokeapi.co/api/v2/type/5/',
            'rock' => 'https://pokeapi.co/api/v2/type/6/',
            'bug' => 'https://pokeapi.co/api/v2/type/7/',
            'ghost' => 'https://pokeapi.co/api/v2/type/8/',
            'steel' => 'https://pokeapi.co/api/v2/type/9/',
            'fire' => 'https://pokeapi.co/api/v2/type/10/',
            'water' => 'https://pokeapi.co/api/v2/type/11/',
            'grass' => 'https://pokeapi.co/api/v2/type/12/',
            'electric' => 'https://pokeapi.co/api/v2/type/13/',
            'psychic' => 'https://pokeapi.co/api/v2/type/14/',
            'ice' => 'https://pokeapi.co/api/v2/type/15/',
            'dragon' => 'https://pokeapi.co/api/v2/type/16/',
            'dark' => 'https://pokeapi.co/api/v2/type/17/',
            'fairy' => 'https://pokeapi.co/api/v2/type/18/',
            'unknown' => 'https://pokeapi.co/api/v2/type/10001/',
            'shadow' => 'https://pokeapi.co/api/v2/type/10002/',
            // Agrega más tipos según sea necesario
        );

        // Verificar si el tipo de Pokémon proporcionado está en el array
        if (array_key_exists($tipo, $tipos_pokemon)) {
            
            $datApi= apiSearshing($tipos_pokemon[$tipo]);
            $data= json_decode($datApi,true);

            echo('<h4>Listando Pokemones de tipo: <b>'. $tipo .'.</b></h4>');

            //$contador = 0; // Inicializamos un contador
            foreach ($data["pokemon"] as $i => $pokemon):
                if (($limit == 0) || ($i < $limit)) { // Verificar si no hay límite o si aún no hemos alcanzado el límite
                    $img = getPokeImg($pokemon['pokemon']['url']);
                    ?>
                    <div class="pokemonItem">
                        <div class="pokemonImage"> <img src="<?php echo($img); ?>" /></div>
                        <div class="pokemonName"> <?php echo($pokemon['pokemon']['name']); ?> </div>
                    </div>
                    <?php
                    //$contador++; // Incrementamos el contador después de mostrar cada pokemon
                } else {
                    break; // Terminamos el bucle si hemos alcanzado el límite
                }
            endforeach;
        } else {
            return 'Tipo de Pokémon no válido';
        }
    //}
}
// Registrar el shortcode
add_shortcode('pokemon_type', 'obtener_nombre_tipo_pokemon');

/*function mostrar_algo_con_shortcode() {
    return '¡Hola desde mi plugin!';
}
add_shortcode('mi_shortcode', 'mostrar_algo_con_shortcode');*/