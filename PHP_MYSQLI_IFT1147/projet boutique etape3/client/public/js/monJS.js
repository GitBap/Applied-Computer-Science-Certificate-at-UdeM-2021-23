let contenu;
let deconnecter = () => {
    //fetch('serveur/pages/deconnecter.php').then(alert("FINI"));
    document.getElementById('dc').submit();
}

let validerFormEnreg = () => {
    let pass = document.getElementById('pass').value;
    let cpass = document.getElementById('cpass').value;
    if (pass === cpass) {
        return true;
    } else {
        return false;
    }
}

function rendreVisible(elem){
	document.getElementById(elem).style.display='block';
}

function rendreInvisible(elem){
	document.getElementById(elem).style.display='none';
}

function lister(){
	document.getElementById('formLister').submit();
}

function validerNum(elem){
	var num=document.getElementById(elem).value;
	var numRegExp=new RegExp("^[0-9]{1,4}$");
	if(num!="" && numRegExp.test(num))
		return true;
	return false;
}

function valider(){
	var num=document.getElementById('num').value;
	var titre=document.getElementById('titre').value;
	var duree=document.getElementById('duree').value;
	var res=document.getElementById('res').value;
	var numRegExp=new RegExp("^[0-9]{1,4}$");
	if(num!="" && titre!="" && duree!="" && res!="")
		if(numRegExp.test(num))
			return true;
	return false;
}

function jouerBande(url){
	document.getElementById('ifba').src=url;
	$('#baModal').modal('show');
}

function editerArticle(unArticle){
	document.getElementById('ida_m').value=unArticle.ida;
	document.getElementById('nom_m').value=unArticle.nomarticle;
	document.getElementById('desc_m').value=unArticle.description;
	document.getElementById('categ_m').value=unArticle.categorie;
	document.getElementById('qted_m').value=unArticle.qteinventaire;
	document.getElementById('seuil_m').value=unArticle.seuil;
	document.getElementById('prix_m').value=unArticle.prix;
	$('#modalEditerArticles').modal('show');
}

let idArticleSupprimer;

function supprimerArticle(ida){
	idArticleSupprimer = ida;
	$('#supprimerArticleModal').modal('show');
}

function supprimer(){
     let formEnlever = document.getElementById('formEnlever');
	 document.getElementById('idar').value = idArticleSupprimer;
	 formEnlever.submit();
}

//Cas d'un button
/*
function valider(){
	var formEnreg=document.getElementById('formEnreg');
	var num=document.getElementById('num').value;
	var titre=document.getElementById('titre').value;
	var duree=document.getElementById('duree').value;
	var res=document.getElementById('res').value;
	var numRegExp=new RegExp("^[0-9]{1,4}$");
	if(num!="" && titre!="" && duree!="" && res!="")
		if(numRegExp.test(num))
			formEnreg.submit();
}
*/

$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	
});


function checkAll()
{
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;              
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
}


let initialiser = (msg) =>{
	if(msg.length > 0){
		let textToast = document.getElementById("textToast");
		let toastElList = [].slice.call(document.querySelectorAll('.toast'))
		let toastList = toastElList.map(function (toastEl) {
			return new bootstrap.Toast(toastEl)
		})
		textToast.innerHTML = msg;
		toastList[0].show();
	}
}

//pour le paginator


var $pagination,
totalRecords = 0,
records = [],
displayRecords = [],
recPerPage = 4,
page = 1,
totalPages = 0;

function genererPagination(){
	$pagination = $('#pagination');
	records = listeArticles;
	//alert(JSON.stringify(records));
	// console.log(records);
	totalRecords = records.length;
	totalPages = Math.ceil(totalRecords / recPerPage);
	apply_pagination();
}

function generate_table() {
    $('#emp_body').html('');
	let rep="";
    for (let unArticle of displayRecords) { 
		rep+=`
			<tr name = "AllArt[]">
				<td>
				<span>
					<input type="checkbox" id="opt" name="options[]" value="${unArticle.ida}" />
				</span>
				</td>
				<td>${unArticle.ida}</td>
				<td><img class='img-fluid'  width='60' height='60' src='../../images_articles/${unArticle.imageart}'></td>
				<td>${unArticle.nomarticle}</td>
				<td>${unArticle.description }</td>
				<td>${unArticle.categorie}</td>
				<td>${unArticle.prix}$</td>
				<td>${unArticle.qteinventaire}</td>
				<td>${unArticle.seuil}</td>
				
				<td>
					<a href="#" onClick='editerArticle(`;
				rep+=JSON.stringify(unArticle);
				rep+=`)' class="edit" data-bs-toggle="modal"><i class="bi bi-pencil" data-toggle="tooltip" title="Modifier"></i></a>
					<a href="#" onClick='supprimerArticle(${unArticle.ida})' class="delete" data-toggle="modal"><i class="bi bi-trash3" data-toggle="tooltip" title="Enlever"></i></a>
				</td>
			</tr>`;
    }
	$('#emp_body').html(rep);
}	

function apply_pagination() {
    $pagination.twbsPagination({
          totalPages: totalPages,
          visiblePages: 6,
          onPageClick: function (event, page) {
                displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                endRec = (displayRecordsIndex) + recPerPage;
               
                displayRecords = records.slice(displayRecordsIndex, endRec);
                generate_table();
          }
    });
}

const Recherche = document.getElementById("recherches1");
function research()
{
	var recherche = document.getElementById("recherches1").value;
	let x = document.getElementsByName("AllArt[]");
	for (let tableau of x) {
		if (tableau.style.display === "none" && recherche === ""){
			tableau.style.display = "table-row";
		}
		else
		{
			tableau.style.display = "none";
		}
	}

	if(recherche !== "")
	{
		$('#emp_body1').html('');
		let rep="";
		for (let unArticle of displayRecords) { 
			if(unArticle.nomarticle.search(recherche)!="-1" || unArticle.description.search(recherche)!="-1")
			{
				rep+=`
					<tr name = "AllArt[]">
						<td>
						<span>
							<input type="checkbox" id="opt" name="options[]" value="${unArticle.ida}" />
						</span>
						</td>
						<td>${unArticle.ida}</td>
						<td><img class='img-fluid'  width='60' height='60' src='../../images_articles/${unArticle.imageart}'></td>
						<td>${unArticle.nomarticle}</td>
						<td>${unArticle.description }</td>
						<td>${unArticle.categorie}</td>
						<td>${unArticle.prix}$</td>
						<td>${unArticle.qteinventaire}</td>
						<td>${unArticle.seuil}</td>
						
						<td>
							<a href="#" onClick='editerArticle(`;
						rep+=JSON.stringify(unArticle);
						rep+=`)' class="edit" data-bs-toggle="modal"><i class="bi bi-pencil" data-toggle="tooltip" title="Modifier"></i></a>
							<a href="#" onClick='supprimerArticle(${unArticle.ida})' class="delete" data-toggle="modal"><i class="bi bi-trash3" data-toggle="tooltip" title="Enlever"></i></a>
						</td>
					</tr>`;
			}
		}
		$('#emp_body1').html(rep);
	}

}


function trier(x)
{
	
	articles = new Array();

	for(let i = 0; i<displayRecords.length; i++)
	{
		articles[i] = displayRecords[i];
	}
	
	articlesTrier = [];
	var k = displayRecords.length;
	var j = 0;
	const variable = new String("displayRecords[j]."+x);
	const variable2 = new String("displayRecords[i]."+x);
	//on trie par titre prix ou numéro
	
	do
	{
		j = 0;
		
		if(x === "prix")
		{
			for(let i = 0; i<displayRecords.length; i++)
			{
				if(parseFloat(eval(String(variable))) > parseFloat(eval(String(variable2))))
				{
					j = i;
				}
			}
		}
		else
		{
			for(let i = 0; i<displayRecords.length; i++)
			{
				if(eval(String(variable)) > eval(String(variable2)))
				{
					j = i;
				}
			}
		}
		
		
		articlesTrier[articlesTrier.length] = displayRecords[j];
		displayRecords.splice(j,1);
	}while(articlesTrier.length !== k);
	

	for(let i = 0; i<articles.length; i++)
	{
		displayRecords[i] = articles[i];
	}
	
	let z = document.getElementsByName("AllArt[]");
	for (let tableau of z) {
		if (tableau.style.display === "none"){
		}
		else
		{
			tableau.style.display = "none";
		}
	}

	$('#emp_body1').html('');
		let rep="";
		for (let unArticle of articlesTrier) { 
			
			rep+=`
				<tr name = "AllArt[]">
					<td>
					<span>
						<input type="checkbox" id="opt" name="options[]" value="${unArticle.ida}" />
					</span>
					</td>
					<td>${unArticle.ida}</td>
					<td><img class='img-fluid'  width='60' height='60' src='../../images_articles/${unArticle.imageart}'></td>
					<td>${unArticle.nomarticle}</td>
					<td>${unArticle.description }</td>
					<td>${unArticle.categorie}</td>
					<td>${unArticle.prix}$</td>
					<td>${unArticle.qteinventaire}</td>
					<td>${unArticle.seuil}</td>
					
					<td>
						<a href="#" onClick='editerArticle(`;
					rep+=JSON.stringify(unArticle);
					rep+=`)' class="edit" data-bs-toggle="modal"><i class="bi bi-pencil" data-toggle="tooltip" title="Modifier"></i></a>
						<a href="#" onClick='supprimerArticle(${unArticle.ida})' class="delete" data-toggle="modal"><i class="bi bi-trash3" data-toggle="tooltip" title="Enlever"></i></a>
					</td>
				</tr>`;
		}
		$('#emp_body1').html(rep);

	
	
}