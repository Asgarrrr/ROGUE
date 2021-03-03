const toggleStats = document.getElementById("toggle")
    , menuStats   = document.getElementById("charscreen");

toggleStats.addEventListener("click", () => menuStats.classList.toggle("open") , true);
