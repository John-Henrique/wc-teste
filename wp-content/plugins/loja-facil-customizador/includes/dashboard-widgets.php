<?php 

add_action( 'wp_dashboard_setup', 'dw_dashboard_add_widgets' );
function dw_dashboard_add_widgets() {
	wp_add_dashboard_widget( 'lf_dashboard_widget_ajuda', __( 'Base de conhecimento', 'lf' ), 'lf_dashboard_widget_ajuda', 'dw_dashboard_widget_news_config_handler' );

    if( function_exists( "is_woocommerce_activated" ) ){
        wp_add_dashboard_widget( 'lf_dados_vendas', __( 'Vendas', 'lf' ), 'lf_dados_vendas', 'dw_dashboard_widget_news_config_handler' );
        //wp_add_dashboard_widget( 'lf_dashboard_widget_produtos_ontem', __( 'Vendas de ontem', 'lf' ), 'lf_dashboard_widget_produtos_ontem', 'dw_dashboard_widget_news_config_handler' );
        //wp_add_dashboard_widget( 'lf_dashboard_widget_produtos_mes_atual', __( 'Vendas este mês', 'lf' ), 'lf_dashboard_widget_produtos_mes_atual', 'dw_dashboard_widget_news_config_handler' );
        //wp_add_dashboard_widget( 'lf_dashboard_widget_produtos_mes_passado', __( 'Vendas mês passado', 'lf' ), 'lf_dashboard_widget_produtos_mes_passado', 'dw_dashboard_widget_news_config_handler' );
    }
}

function lf_dashboard_widget_ajuda() {
	$options = wp_parse_args( get_option( 'dw_dashboard_widget_news' ), array( 'items' => 10, 'target' => "_blank" ) );

	$feeds = array(
		array(
			'url'          => 'https://woocommerce.com.br/feed/',
			'items'        => $options['items'],
			'items'        => 2,
			'show_summary' => 1,
			'show_author'  => 0,
			'show_date'    => 0,
		),
	);

	wp_dashboard_primary_output( 'dw_dashboard_widget_news', $feeds );
}


/**
 * Lista os dados sobre vendas 
 * hoje
 * ontem
 * este mês
 * mês anterior
 */
function lf_dados_vendas(){

    $html = "<ul class='lf_status'>
        <li class='vendas-hoje'>". lf_dashboard_widget_produtos() ."</li>
        <li class='vendas-ontem'>". lf_dashboard_widget_produtos_ontem() ."</li>
        <li class='vendas-mes-atual'>". lf_dashboard_widget_produtos_mes_atual() ."</li>
        <li class='vendas-mes-anterior'>". lf_dashboard_widget_produtos_mes_passado() ."</li>
    </ul>
    <br style='clear:left;'>
    ";

    echo $html;
}

/**
 * Total de pedidos
 * Hoje qtd
 * Total R$ 
 * Ticket médio
 */
function lf_dashboard_widget_produtos() {

    // Get orders from people named John that were paid in the year 2016.
    $orders = wc_get_orders( array(
        //'billing_first_name' => 'John',
        //'date_paid' => '2021-02-01...2021-02-31',
        'date_paid' => date("Y-m-d"),
    ) );
    
    $total = count( $orders );
    
    $total_rs = 0;
    
    foreach( $orders as $order ){
       $total_rs = ( $total_rs + $order->total );
    }

    $total_rsf = ($total_rs)?$total_rs:0;

    if( $total_rs == 0 ){
        $ticket_mediop = 0;
    }else{
        $ticket_mediop = ( $total_rsf / $total );
    }
    $ticket_medio = ($ticket_mediop)?$ticket_mediop:0;

    $txt  = "<strong>Hoje, ". date("D, d", strtotime( "NOW" )) ."</strong><br>";
    $txt .= "Pedidos: ". $total ."<br>";
    $txt .= "Total: ". wc_price( $total_rsf ) ."<br>";
    $txt .= "Ticket médio: ". wc_price( $ticket_medio ) ."<br>";

    return $txt;
}



function lf_dashboard_widget_produtos_ontem() {

    // Get orders from people named John that were paid in the year 2016.
    $orders = wc_get_orders( array(
        //'billing_first_name' => 'John',
        //'date_paid' => '2021-02-01...2021-02-31',
        'date_paid' => date("Y-m-d", strtotime( "-1 DAY" )),
    ) );
    
    $total = count( $orders );
    
    $total_rs = 0;
    
    foreach( $orders as $order ){
       $total_rs = ( $total_rs + $order->total );
    }


    $total_rsf = (0 != $total_rs)?$total_rs:0;

    if( $total_rs == 0 ){
        $ticket_mediop = 0;
    }else{
        $ticket_mediop = ( $total_rsf / $total );
    }
    $ticket_medio = (isset( $ticket_mediop ) && ( is_numeric( $ticket_mediop ) ) )?$ticket_mediop:0;

    $txt  = "<strong>Ontem, ". date("D, d", strtotime( "-1 day" )) ."</strong><br>";
    $txt .= "Pedidos: ". $total ."<br>";
    $txt .= "Total: ". wc_price( $total_rsf ) ."<br>";
    $txt .= "Ticket médio: ". wc_price( $ticket_medio ) ."<br>";

    return $txt;
}




function lf_dashboard_widget_produtos_mes_atual() {

    // Get orders from people named John that were paid in the year 2016.
    $orders = wc_get_orders( array(
        //'billing_first_name' => 'John',
        //'date_paid' => '2021-02-01...2021-02-31',
        'date_paid' => date("m", strtotime( "NOW" )),
    ) );
    
    $total = count( $orders );
    
    $total_rs = 0;
    
    foreach( $orders as $order ){
       $total_rs = ( $total_rs + $order->total );
    }


    $total_rsf = ($total_rs)?$total_rs:0;

    if( $total_rs == 0 ){
        $ticket_mediop = 0;
    }else{
        $ticket_mediop = ( $total_rsf / $total );
    }
    $ticket_medio = ($ticket_mediop)?$ticket_mediop:0;

    $txt  = "<strong>Este mês, ". date("M", strtotime( "NOW" )) ."</strong><br>";
    $txt .= "Pedidos: ". $total ."<br>";
    $txt .= "Total: ". wc_price( $total_rsf ) ."<br>";
    $txt .= "Ticket médio: ". wc_price( $ticket_medio ) ."<br>";

    return $txt;
}




function lf_dashboard_widget_produtos_mes_passado() {

    // Get orders from people named John that were paid in the year 2016.
    $orders = wc_get_orders( array(
        'date_paid' => date("m", strtotime( "-1 MONTH" )),
    ) );
    
    $total = count( $orders );
    
    $total_rs = 0;
    
    foreach( $orders as $order ){
       $total_rs = ( $total_rs + $order->total );
    }

    $total_rsf = ($total_rs)?$total_rs:0;

    if( $total_rs == 0 ){
        $ticket_mediop = 0;
    }else{
        $ticket_mediop = ( $total_rsf / $total );
    }
    $ticket_medio = ($ticket_mediop)?$ticket_medio:0;

    $txt  = "<strong>Mês passado, ". date("M", strtotime( "-1 MONTH" )) ."</strong> <br>";
    $txt .= "Pedidos: ". $total ."<br>";
    $txt .= "Total: ". wc_price( $total_rsf ) ."<br>";
    $txt .= "Ticket médio: ". wc_price( $ticket_medio ) ."<br>";

    return $txt;
}





?>