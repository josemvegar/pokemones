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

 class listingShortCodes {

    public static function apiConection($url){
        $curl=curl_init();
        //$url="https://pokeapi.co/api/v2/";
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function listingTypes(){

        $datapi= self::apiConection('https://pokeapi.co/api/v2/type/');
        $data= json_decode($datapi,true);

        ?>
        <div class="meta-box-sortables">
            <div class="postbox">
                <h2><span><?php esc_attr_e(
                            'Shordcodes para mostrar pokemones.', 'pokemones'
                        ); ?></span></h2>
                <p><span><?php esc_attr_e(
                            'Haz click sobre un shortcode para copiar.', 'pokemones'
                        ); ?></span></p>
                <div class="inside">
                <table class="widefat">
                        <?php
                            foreach ($data["results"] as $i => $result): 
                                $pokemon_type = "[pokemon_type_" . $result["name"] . "]";
                        ?>
                                <tr class="<?php echo ($i%2!=0) ?  "alternate" : "" ; ?>">
                                    <td class="row-title pokeshortcode"><?php esc_attr_e($pokemon_type, 'pokemones' ); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    <?php

    }
 }