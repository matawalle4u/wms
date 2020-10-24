
    function menu(menus, submenus){
        //alert('hey');
        for(let i=0; i<=menus.length-1; i++){
            let menu = menus[i];

            //This gets the submenu
            if(submenus[i] !=null){

            
            for(let j=0; j<=submenus[i].length-1; j++){
                let subMenu = submenus[i][j];

                console.log(menu, subMenu);
                //if submenu is an array what becomes the parent
            }

        }else{
            
        }

            

            //console.log(menu);
        }
    }