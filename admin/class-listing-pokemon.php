<?php

/**
 * Show the option in wordpress menu admin.
 *
 * @link       https://www.instagram.com/josemanuel.vega.73/
 * @since      1.0.0
 *
 * @package    Pokemones
 * @subpackage Pokemones/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Pokemones
 * @subpackage Pokemones/includes
 * @author     José Vega <josevega1999.16@gmail.com>
 */

 class listingPokemon {

    public static function apiConection($url){
        $curl=curl_init();
        //$url="https://pokeapi.co/api/v2/";
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function getPokeInfo($url){
        $data= json_decode(self::apiConection($url), true);
        return $data;
    }

    public static function listingPokemon($url="https://pokeapi.co/api/v2/pokemon?offset=0&limit=50"){
        if(isset($_POST['pagination_url'])){
            $url=$_POST['pagination_url'];
            //echo $_POST['pagination_url'];
        }
        $datapi= self::apiConection($url);
        $data= json_decode($datapi,true);
        ?>

        <table class="widefat">
            <thead>
            <tr>
                <th class="row-title"><?php esc_attr_e( 'Imagen', 'pokemones' ); ?></th>
                <th class="row-title"><?php esc_attr_e( 'Nombre de Pokemon', 'pokemones' ); ?></th>
                <th class="row-title"><?php esc_attr_e( 'Tipo', 'pokemones' ); ?></th>
            </tr>
            </thead>
            <tbody>
                
            <?php
                foreach ($data["results"] as $i => $result):   
                    $info=self::getPokeInfo($result["url"]); 
                    
                    $typeResult = '';
                    // Itera sobre el arreglo
                    foreach ($info["types"] as $index => $type) {
                        if ($index > 0) {
                            $typeResult .= ', ';
                        }
                        $typeResult .= $type["type"]["name"];
                    }

            ?>
                <tr class="<?php echo ($i%2!=0) ?  "alternate" : "" ; ?>">
                    <td class="poke-admin-image"><img src="<?php echo($info["sprites"]["front_default"]); ?>" alt="<?= ucfirst($result["name"]) ?>"></td>
                    <td class="row-title"><?php esc_attr_e( ucfirst($result["name"]), 'pokemones' ); ?></td>
                    <td class="row-title"><?php esc_attr_e( ucfirst($typeResult), 'pokemones' ); ?></td>
                </tr>
            <?php
                endforeach;
            ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="tablenav">
            <div class="tablenav-pages">
                <?php if (!empty($data["previous"])): ?>
                    <a class='prev-page' title='Go to previous page' href='#' onclick="submitForm(`<?php echo $data['previous']; ?>`)">&lsaquo;</a>
                <?php else: ?>
                    <a class='prev-page disabled' title='No previous page available' href='#'>&lsaquo;</a>
                <?php endif; ?>
                
                <?php if (!empty($data["next"])): ?>
                    <a class='next-page' title='Go to next page' href='#' onclick="submitForm(`<?php echo $data['next']; ?>`)">&rsaquo;</a>
                <?php else: ?>
                    <a class='next-page disabled' title='No next page available' href='#'>&rsaquo;</a>
                <?php endif; ?>
            </div>
        </div>
        
        <?php

    }

 }