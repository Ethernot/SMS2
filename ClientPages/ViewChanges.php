<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Switch Management Software</title>
        <link rel="stylesheet" type="text/css" href="Css/stylesheet.css"/>
    </head>
    <body>
        <header class="mainHeader">
            <span>S M S</span>
            <span>**Switch Management Software**</span>
        </header>
        <div class="logs">

            <?php
            require_once("../Server/Database.php");
            $db = new Database();
            $logs = explode("\n", $db->getLogs());
            //            echo '<ul>';
            //            foreach ($logs as $log) {
            //                if (strlen($log) > 1) {
            //                    echo '<li><p>' . $log . '</p></li>';
            //                }
            //            }
            //            echo '</ul>';
            ?>

            <table>
                <thead>
                    <th>title</th>
                    <th>title2</th>
                    <th>title3</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>4</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>5</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer class="mainFooter">
            <p> Copyright & copy; <span> Ethernot Team </span></p>
        </footer>
    </body>
</html>