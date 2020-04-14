

/***********************************************************************
*                        Created by Mr MONTCHO P. C.                                              *
*                                                                      *
*                                                                      *
*                                                                      *
*                                                                      *
************************************************************************/

function moncac(tab,id){
    //on parcour le tableau en cachant tous les élément du tableau 
    for(var i=0;i<tab.length;i++){
        caches(tab[i]);
    }
    montre(id);
}

function caches(tab){
    $(tab).hide();//c'est une fonction jquery qui permet de cacher un élément 
}
function montre(tab){
    $(tab).show();//c'est une fonction jquery qui permet de montrer un élément
}


function globalAJAX(c, u, p, f)
{
    switch(c){
        case 1:
            $.ajax({
                type: "POST",
                url: u,
                data: p,
                success: f,
                dataType: "json"
            });
        break;
        case 2:
            $.ajax({
                type: "POST",
                url: u,
                success: f,
                dataType: "json"
            });
        break;
    }
}

function remplirSelect(ch, id, long, tab){
    $(id).html("");
    $(id).append('<option value="">&nbsp;</option>');
    switch(ch){
        case 1:
            for(i=0; i<long; i++){
                $(id).append('<option value="'+tab[i][0]+'">'+tab[i][1]+'</option>');
            }
        break;
        case 2:

        break;
    }
}

function razFermeModal(choix, clicMenu, leModal, btnRAZ){
    switch(choix){
        case 1:
            $(btnRAZ).trigger('click');
            $(clicMenu).trigger('click');
            $(leModal).modal('hide');
        break;
        case 2:
            $(clicMenu).trigger('click');
            $(leModal).modal('hide');
        break
    }
}