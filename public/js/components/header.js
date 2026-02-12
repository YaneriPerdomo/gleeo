import {
    headerNavigationBarListItem,
    tutorSettingsListIcons,
    url,
} from "../variables.js";

function header(){

if (url.href.includes("/configuracion-del-tutor")) {
    if (url.href.includes("/alerta-intervencion-requerida")) {
        tutorSettingsListIcons[1].classList.add("item-selected");
        headerNavigationBarListItem[1].classList.add("item-selected--nav");
    } else {
        tutorSettingsListIcons[0].classList.add("item-selected");
        headerNavigationBarListItem[1].classList.add("item-selected--nav");
    }
}
else if (url.href.includes("/inicio")) {
    tutorSettingsListIcons[0].classList.add("item-selected");

    headerNavigationBarListItem[0].classList.add("item-selected--nav");
}
else if (url.href.includes("/perfil")) {
    if(url.href.includes("/eliminar-cuenta")){
        return tutorSettingsListIcons[3].classList.add("item-selected");
    }
    if (url.href.includes("/acceso")) {
        tutorSettingsListIcons[2].classList.add("item-selected");
    } else if (url.href.includes("/cuenta")) {
        tutorSettingsListIcons[1].classList.add("item-selected");
    }
     else {
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
}
else if (url.href.includes("/gestion-de-cuentas")) {
    if (url.href.includes("representante-y-profesionale") ||
        url.href.includes("representantes-y-profesionales")
    ) {
        headerNavigationBarListItem[3].classList.add("item-selected--nav");
        tutorSettingsListIcons[0].classList.add("item-selected");
    }

    if (url.href.includes("jugadores") ||
        url.href.includes("jugador")
    ) {
        headerNavigationBarListItem[1].classList.add("item-selected--nav");
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
}
else if (url.href.includes("/plataforma-educativa")) {
    if (url.href.includes("/plataforma-educativa/informacion-general")
    ) {
        headerNavigationBarListItem[2].classList.add("item-selected--nav");
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
    if (url.href.includes("/plataforma-educativa/plan-de-estudio")
    ) {
        headerNavigationBarListItem[2].classList.add("item-selected--nav");
        tutorSettingsListIcons[1].classList.add("item-selected");
    }
    if (url.href.includes("/plataforma-educativa/avatares") || url.href.includes("/plataforma-educativa/avatar")
    ) {
        headerNavigationBarListItem[2].classList.add("item-selected--nav");
        tutorSettingsListIcons[2].classList.add("item-selected");
    }
    if (url.href.includes("/plataforma-educativa/temas-de-interfaz") || url.href.includes("/plataforma-educativa/temas-de-interfaz")
    ) {
        headerNavigationBarListItem[2].classList.add("item-selected--nav");
        tutorSettingsListIcons[3].classList.add("item-selected");
    }
} else if(url.href.includes("/niveles") && !tutorSettingsListIcons.length){
    if (url.href.includes("/ranking-por-nivel")
    ) {
        return headerNavigationBarListItem[1].classList.add("item-selected--nav");
    }
    if (url.href.includes("/progreso-por-nivel")
    ) {
        return headerNavigationBarListItem[2].classList.add("item-selected--nav");
    }
    if (url.href.includes("/nivel")
    ) {
       return  headerNavigationBarListItem[0].classList.add("item-selected--nav");
    }
}

}

header()
