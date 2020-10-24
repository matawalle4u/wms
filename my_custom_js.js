/*
    Adam Mustapha Kanya
    matawalle4u@gmail.com
    +234 902 816 3380
*/

function load_menu(menu_icon, main,sub_menu, hrefs){
    
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
            document.write('<div class="form-group row"><label class="col-md-3 label-control">'+label+'</label><div class="col-md-9"><select name="'+name+'" id="'+name+'" class="form-control" required><option value="">Select '+label+'</option>');
            
            for(var j=0; j<=select.length-1; j++){
                document.write('<option value="'+opt[j]+'">'+select[j]+'</option>');
            }

            document.write('</select></div></div>');
            counter+=1;
        }else if(types[i]=='textarea'){
            document.write('<div class="form-group row"><label class="col-md-3 label-control">'+label+'</label><div class="card-body"><fieldset class="form-group"><textarea class="form-control" rows="3" name="'+name+'" id="'+name+'" placeholder="'+label+'"></textarea></fieldset></div></div>');
        }else{
            document.write('<div class="form-group row"> <label class="col-md-3 label-control">'+label+'</label> <div class="col-md-9"><input type="'+type+'" name="'+name+'" id="'+name+'" placeholder="'+label+'" class="form-control"> </div></div>');
        }
    }
}


function summary_icons(titles, icons, datas, colors){
    //document.write('<div class=row>');
    for(var i=0; i<=titles.length-1; i++){
        document.write(
        '<div class="col-xl-2 col-lg-6 col-12">'
            +'<div class="card">'+
                '<div class="card-content">'+
                    '<div class="card-body">'+
                        '<div class="media d-flex">'+
                                '<div class="align-self-center">'+
                                    '<i class="fa fa-'+icons[i]+ ' '+colors[i]+' font-large-2 float-left"></i>'+
                                '</div>'+
                                '<div class="media-body text-right">'+
                                    '<h5>'+datas[i]+'</h5>'+
                                    '<span>'+titles[i]+'</span>'+
                                '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>'
        );            
        //document.write('<div class="col-xl-2 col-lg-6 col-12"><div class="card"><div class="card-content"><div class="card-body"><div class="media d-flex"><div class="align-self-center"><i class="fa fa-building info font-large-2 float-left"></i></div><div class="media-body text-right"><h5>333</h5><span>Warehouse</span></div></div></div></div></div></div> ');
    }

    //document.write('</div>');
}

function load_container(containers, classes, contents){
    
    document.write('Loading container');
}


function validate_input(){
    alert('Validated');
    //Handle input validation and return an array
}