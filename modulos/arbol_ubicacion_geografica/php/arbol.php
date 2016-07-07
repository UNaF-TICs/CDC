<html>
<head>
    <!-- Include the required JavaScript libraries: --> 

    <!-- Add code to initialize the tree when the document is loaded: -->
    <script type="text/javascript">
    function clickear(){
        // Attach the dynatree widget to an existing <div id="tree"> element
        // and pass the tree options as an argument to the dynatree() function:
        $("#arbol").dynatree({
            onActivate: function(node) {
                // A DynaTreeNode object is passed to the activation handler
                // Note: we also get this event, if persistence is on, and the page is reloaded.
                alert("You activated " + node.data.title);
            },
            persist: true,
            children: [ // Pass an array of nodes.
                {title: "Pais",
                    children: [
                        {title: "Argentina",
                            children: [
                                {title: "Formosa"},
                                {title: "Corrientes"}
                            ]
                        },
                        {title: "Paraguay"}
                    ]
                }
            ]
        });
    };
    </script>
</head>
<body>
    <!-- Add a <div> element where the tree should appear: -->
    <div id="arbol"> </div>
</body>
</html>