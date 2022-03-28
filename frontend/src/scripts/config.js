const config = getConfig(relativePath);
async function getConfig(relativePath = "") {
    let config = await fetch(relativePath + 'config.json');
    return JSON.parse(await config.text());
}

