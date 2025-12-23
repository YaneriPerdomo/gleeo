import {
    headerNavigationBarListItem,
    tutorSettingsListIcons,
    url,
} from "../variables.js";

if (url.href.includes("/configuracion-del-tutor")) {
    if (url.href.includes("/alerta-intervencion-requerida")) {
        tutorSettingsListIcons[1].classList.add("item-selected");
        headerNavigationBarListItem[1].classList.add("item-selected--nav");
    } else {
        tutorSettingsListIcons[0].classList.add("item-selected");
        headerNavigationBarListItem[1].classList.add("item-selected--nav");
    }
}
else if (url.href.includes("/bienvenido-a")) {
    tutorSettingsListIcons[0].classList.add("item-selected");

    headerNavigationBarListItem[0].classList.add("item-selected--nav");
}
else if (url.href.includes("/perfil")) {
    if (url.href.includes("/acceso")) {
        tutorSettingsListIcons[2].classList.add("item-selected");
    } else if (url.href.includes("/cuenta")) {
        tutorSettingsListIcons[1].classList.add("item-selected");
    } else {
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
}
else if (url.href.includes("/gestion-de-cuentas")) {
    if (url.href.includes("/gestion-de-cuentas")
    ) {
        headerNavigationBarListItem[3].classList.add("item-selected--nav");
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
}
else if (url.href.includes("/plataforma-educativa")) {
    if (url.href.includes("/plataforma-educativa/plan-de-estudio")
    ) {
        headerNavigationBarListItem[2].classList.add("item-selected--nav");
        tutorSettingsListIcons[0].classList.add("item-selected");
    }
}
