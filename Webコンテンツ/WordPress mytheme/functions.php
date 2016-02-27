<?php
//ウィジェット機能追加 コンテンツの中にメニュー追加




     
register_sidebar(array('id'=>"sidebar-1"));
      

      
//RSSフィード追加
add_theme_support('automatic-feed-links');     
    
// カスタムメニュー追加

 register_nav_menu('navigation','ナビゲーション');









?>