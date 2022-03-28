const config = getConfig(relativePath);
let ajaxPath;

async function getConfig(relativePath = "") {
    let config = await fetch(relativePath + 'config.json');
    config = JSON.parse(await config.text());
    ajaxPath = relativePath+config["ajaxPath"];
    return config;
}

