async function ajaxClass(Class, Function, Parameters = [], ConstructArgs = []) {
    let formData = new FormData();
    formData.append('class', Class);
    formData.append('function', Function);
    formData.append('parameters', JSON.stringify(Parameters));
    formData.append('constructArgs', JSON.stringify(ConstructArgs));

    const promise = await fetch(ajaxPath, {
        method: 'post',
        body: formData,
        headers: {'Accept': 'application/json'}})
        .then((response)=>response.json())
        .then((responseJson)=>{return responseJson});
    return promise;

}

