<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
        <tr>
            <td style="padding: 20px 0 20px 20px; width: 48%;">
                <?php 
                printf('<h2><a href="%s" target="_blank">%s</a></h2>', get_site_url() ,get_bloginfo("name"))
                ?>
                </td>
         </tr> 
         <tr> 
         <td align="center" >
                <h2 style="font-size:26px; font-family: 'Roboto', sans-serif; color: #000000; line-height:1; font-weight:700;margin: 0 0 20px;"> <?php _e('WELCOME ','wcua' ); echo get_bloginfo("name"); ?></h2>
                <p style="font-size:16px; line-height:28px; font-family: 'Roboto', sans-serif; color:#000000; font-weight:300; margin: 0 0 30px;">
                    <?php 
                    _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','wcua' );
                    ?> 
                    </p>    
        </td>
         </tr> 
         <tr>
            <td align="center" style="padding: 0 15px;">
                    {{Product image}}
                    {{Product description}}
                    {{Product buy button}}
            </td>
        </tr>
        
        </tr>
</table>

