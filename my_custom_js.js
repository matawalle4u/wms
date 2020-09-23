/*
    Adam Mustapha Kanya
    matawalle4u@gmail.com
    +234 902 816 3380
*/

function load_menu(menu_icon, main,sub_menu, hrefs){
    for(var i=0; i<=main.length-1; i++){
        if(sub_menu[i].length>0){
            document.write('<li><a href="#" data-toggle="collapse-next" class="has-submenu"><em class="fa '+menu_icon[i]+'"></em><span class="item-text">'+main[i] +'</span></a><ul class="nav collapse">');
        }else{
            document.write('<li><a href="'+hrefs[i]+'"><em class="fa '+menu_icon[i]+'"></em><span class="item-text">'+main[i] +'</span></a><ul class="nav collapse">');
        }
        for(var j=0; j<=sub_menu[i].length-1; j++){
            if(hrefs[i][j].startsWith('Modal', 0)){
                document.write('<li><a href="#" data-toggle="modal" data-target="#'+hrefs[i][j]+'" class="no-submenu"><span class="item-text">'+sub_menu[i][j] +'</span></a></li>');
            }else{
                document.write('<li><a href="'+hrefs[i][j]+'" class="no-submenu"><span class="item-text">'+sub_menu[i][j] +'</span></a></li>');
            }
        }
        document.write('</li></ul>');
    }
}

function generate_form(names, types, selects, opts, labels){
    var counter = 0;
    for(var i=0; i<=names.length-1; i++){
        var name = names[i];
        var type = types[i];
        var label = labels[i];
        if(types[i]=='select'){
            var select = selects[counter];
            var opt  = opts[counter];
            document.write('<div class="form-group row"><label class="col-md-3 label-control">'+label+'</label><div class="col-md-9"><select name="'+name+'" class="form-control" required><option value="">Select '+label+'</option>');
            
            for(var j=0; j<=select.length-1; j++){
                document.write('<option value="'+opt[j]+'">'+select[j]+'</option>');
            }

            document.write('</select></div></div>');
            counter+=1;
        }else if(types[i]=='textarea'){
            document.write('<div class="form-group row"><label class="col-md-3 label-control">'+label+'</label><div class="card-body"><fieldset class="form-group"><textarea class="form-control" rows="3" name="'+name+'" placeholder="'+label+'"></textarea></fieldset></div></div>');
        }else{
            document.write('<div class="form-group row"> <label class="col-md-3 label-control">'+label+'</label> <div class="col-md-9"><input type="'+type+'" name="'+name+'" placeholder="'+label+'" class="form-control"> </div></div>');
        }
    }
}

function load_container(containers, classes, contents){
    
    document.write('Loading container');
}


function validate_input(){
    //Handle input validation and return an array
}