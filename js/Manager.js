function set() {
    $(function () {
        $(".btn").on("click", function () {
            //The data base address goes "#"
            var results = $.get("#");
            results.done(function (data) {
                
                for (var i =0; i<data.length; i++){
                    var tr = $("<tr></tr>")
                    tr.append($("<td>"+data[i].id+"</td>"));
                    tr.append($("<td>"+data[i].item+"</td>"));
                    tr.append($("<td>"+data[i].Amount_Sold+"</td>"));
                    tr.append($("<td>"+data[i].Item_Price+"</td>"));
                    tr.append($("<td>"+data[i].Total_Price+"</td>"));
                    $("table").append(tr);
                }
            })
        })
    })
}
window.onload=set;