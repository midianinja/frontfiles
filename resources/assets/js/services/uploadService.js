const url = '/upload'
function upload(data){
	//add data
	let form = formDataFactory(data.data)

	//add img
	form.append('video',data.file,data.name)

	//upload
	return new Promise((resolve,reject) =>
		http.post(window.location.protocol + "//" + window.location.host + url,form)
		.then(resolve)
		.catch(reject)
	)
}

function formDataFactory(data){
	let form= new FormData()
	for(let key in Object.keys(data)){
		form.append(key,data[key])
	}
	return form
}
export {
	upload	
}