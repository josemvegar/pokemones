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
class Pokemones_MenuAdmin {

    public static function jmAddMenuItem(){
        add_menu_page( 
            'Pokemones', 
            'Pokemones JM', 
            'manage_options',
            'pk_options',
             array( 'Pokemones_MenuAdmin', 'jmOptionsPokemones' ),
            'dashicons-image-filter',
            '65'
        );
    }

    public static function jmOptionsPokemones(){

        $listing= new listingPokemon;

        ?> 
        
        <div class="wrap">

            <div id="icon-options-general" class="icon32"></div>
            <h1><?php //esc_attr_e( 'Heading', 'WpAdminStyle' ); ?></h1>
            <h1><?php echo get_admin_page_title();  ?></h1>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">

                    <!-- main content -->
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <div class="postbox">
                                <h2><span><?php esc_attr_e( 'Listado de pokemones', 'pokemones' ); ?></span></h2>
                                <div class="inside">
                                    <p><?php esc_attr_e(
                                            'En esta lista puedes encontrar todos los pokemones en el api ',
                                            'pokemones'
                                        ); ?><a href="https://pokeapi.co/api/v2/">https://pokeapi.co/api/v2/</a>.</p>


                                        <!-- Listing -->
                                        <?php 

                                            $listing->listingPokemon();
                                        
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- sidebar -->
                    <div id="postbox-container-1" class="postbox-container">
                        <div class="meta-box-sortables">
                            <div class="postbox">
                                <h2><span><?php esc_attr_e(
                                            'Shordcodes para mostrar pokemones.', 'pokemones'
                                        ); ?></span></h2>
                                <div class="inside">
                                    <table class="widefat">
                                        <tr>
                                            <td class="row-title"><label for="tablecell"><?php esc_attr_e( '[pokemon_type_agua]', 'pokemones' ); ?></label></td>
                                        </tr>
                                        <tr class="alternate">
                                            <td class="row-title"><label for="tablecell"><?php esc_attr_e( '[pokemon_type_agua]', 'pokemones' ); ?></label></td>
                                        </tr>
                                        <tr>
                                            <td class="row-title"><label for="tablecell"><?php esc_attr_e( '[pokemon_type_agua]', 'pokemones' ); ?></label></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div> <!-- .wrap -->
        <?php
    }
}