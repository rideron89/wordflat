<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wordflat
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?=get_template_directory_uri()?>/assets/favicon.ico">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card header">
                    <h1 class="site-title"><a href="<?= esc_url( home_url( '/' ) ) ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                    <div class="header-bg-image" style="background-image: url(<?= get_header_image() ?>);"></div>
                </div>
            </div>
        </div>

        <div class="row spacer"></div>
