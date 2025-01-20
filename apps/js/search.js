document.querySelector('#search-btn').onclick = function(){
    let val = document.querySelector('#searchInput').value.replaceAll(/\s/g,'');
    if (val != '') {
      const matches = [];

    for (const div of document.querySelectorAll('section')) {
      if (div.textContent.toLowerCase().includes(val.toLowerCase())) {
        matches.push(div);

        for (const item of document.querySelectorAll('.menu, .popular')){
          if (item.textContent.toLowerCase().includes(val.toLowerCase())) item.style["boxShadow"] = "0px 0px 30px rgb(255, 255, 255)";
        }
      } else{
        div.style.display = 'none';
    }
  }
    }
    
}