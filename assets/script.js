		 //Функция для 1-го задания
		 function sendSubmitFetch(){
			let form = $('form'), result = $('#result');
			form.addEventListener('submit', function(event){
			let promise = sendFetch('/ajax.php', 'POST', new FormData(this));
			promise.then(
				response => {
					return response.json();
				}
			).then(
				data => {
					if(data.status == 'success'){	
						result.innerHTML = data.email + ' - ' + data.user_name + ' ' + data.user_sname + ' ' + '[id = ' + data.user_id + ']';
						result.classList.add(data.status);
						document.body.appendChild(result);
					}else{
						console.log(data);
						errorStatus(result, data);
					}
				});
			event.preventDefault();
		  });
		}
		  
		  //Функция для 2-го задания
		  function sendKeyUpFetch(){
			  let input = $('input[name="text_submit"]'), result = $('#result');
			  input.addEventListener('keyup', () => {
				let formData = new FormData();
				formData.set('text_keyup', input.value);
				let promise = sendFetch('/ajax.php', 'POST', formData);
				promise.then(
						response => {
							return response.json();
						}
					).then(
					data => {
						if(data.status == 'success'){	
							keyUpSuccess(result, data);
						}else{
							errorStatus(result, data);
						}
					});		  
			  });  	
		  }


			function getObjectLength(data){
				let count = 0;
					for (let key in data) {
					    count++
					}	
				return count;
			}

			function $(selector){
				return document.querySelector(selector);
			}

			function errorStatus(elem, data){
				elem.classList.remove('success');
				elem.classList.add(data.status);
				elem.innerHTML = data.text;
			}

			function keyUpSuccess(elem, data){
				let ul = document.createElement('ul');
				for(let i = 0; i < getObjectLength(data) - 1; i++){
					let li = document.createElement('li');
					li.classList.add(data.status);
					li.innerHTML = data[i]['email'] + ' - ' + data[i]['user_name'] + ' ' + data[i]['user_sname'] + ' ' + '[id = ' + data[i]['user_id'] + ']';
					ul.appendChild(li);
				}
				result.innerHTML = ul.innerHTML;
			}
			

			function sendFetch(uri, method, formData){
				return fetch(uri, {
					method: method,
					body: formData,
				});
			}

			sendSubmitFetch(); //Функция для 1 задания
			sendKeyUpFetch();  //Функция для 2 задания
