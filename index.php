<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<main>
    <div id="page-1" class="page">
        <section>
            <h1>Welcome</h1>
            <div>
                <p>Orange Management is a WebApp written in PHP and JavaScript supporting various database 
                and caching technologies. Many Modules/Extensions provide functionality for businesses, 
                education facilities, healthcare facilities and organizations in general.<p>

                <p>In the following pages you'll be guided through the installation process for the WebApp. 
                Most of the customization can be done after installation such as configuring localization, 
                installing additional modules, creating organization etc.</p>

                <p>In case you don't want to use this web installation tool you can also use the console 
                installation tool. Just navigate in your shell to the install directory and then into 
                Console the subdirectory. There you simply run the install script and are good to go.</p>

                <p>In case you encounter any problems during the installation process please feel free to 
                ask for help on our website or contact our support email at 
                <strong>test.email@orange-management.de</strong></p>
                
                <p><button class="next">Next</button></p>
            </div>
        </section>
    </div>
    <div id="page-2" class="page">
        <section>
            <h1>License &amp; User Agreement</h1>
            <div>
                <p>Upon clicking Agree you agree with the following license agreement.</p>

                <blockquote>
                    <p>The OMS License 1.0</p>

                    <p>Copyright (c) <Dennis Eichhorn> All Rights Reserved</p>

                    <p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                    THE SOFTWARE.</p>
                </blockquote>

                <p><button class="prev">Previous</button><button class="next">Agree</button></p>
            </div>
        </section>
    </div>
    <div id="page-3" class="page">
        <section>
            <h1>Pre-installation check</h1>
            <div>
                <p>The following checks show if your environment supports the necessary requirements of the WebApp.</p>
                
                <p>Right next to the check status you can see the type of the requirement. Anything crictial will 
                prevent you from installing the WebApp and must be fixed. Medium indicates that some important features 
                are not available but the WebApp can be still installed. Optional means that only minor features are not 
                available.</p>

                <p>All non critical elements can be fixed after installation if you find yourself in need of one of the 
                features. All critical elements must be fixed before you can continue with the installation.</p>

                <p>For help please check our <a href="">Installation Guide</a>.</p>
                <?php $isOK = version_compare('7.0.0', PHP_VERSION) < 1 && extension_loaded('pdo'); ?>
                <table>
                    <thead>
                        <tr>
                            <th>Status
                            <th>Type
                            <th>Requirement
                            <th>Your Environment
                    <tbody>
                        <tr>
                            <td class="<?= version_compare('7.0.0', PHP_VERSION) < 1 ? 'OK' : 'FAILED'; ?>"><?= version_compare('7.0.0', PHP_VERSION) < 1 ? 'OK' : 'FAILED'; ?>
                            <td>Critcal
                            <td>PHP version >= 7.0.0
                            <td><?= PHP_VERSION; ?>
                        <tr>
                            <td class="<?= extension_loaded('pdo') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('pdo') ? 'OK' : 'FAILED'; ?>
                            <td>Critcal
                            <td>PDO database extension for PHP
                            <td><?= extension_loaded('pdo') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('smtp') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('smtp') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>SMTP extension for PHP
                            <td><?= extension_loaded('smtp') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('imap') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('imap') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>IMAP extension for PHP
                            <td><?= extension_loaded('imap') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('pop3') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('pop3') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>POP3 extension for PHP
                            <td><?= extension_loaded('pop3') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('curl') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('curl') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>cUrl extension for PHP
                            <td><?= extension_loaded('curl') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('ftp') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('ftp') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>FTP extension for PHP
                            <td><?= extension_loaded('ftp') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('bcmath') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('bcmath') ? 'OK' : 'FAILED'; ?>
                            <td>Medium
                            <td>BCMath extension for PHP
                            <td><?= extension_loaded('bcmath') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('mbstring') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('mbstring') ? 'OK' : 'FAILED'; ?>
                            <td>Optional
                            <td>Multibyte extension for PHP for international characters (e.g. chinese, russian)
                            <td><?= extension_loaded('mbstring') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('zip') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('zip') ? 'OK' : 'FAILED'; ?>
                            <td>Optional
                            <td>Zip extension for PHP
                            <td><?= extension_loaded('zip') ? 'Available' : 'Not installed'; ?>
                        <tr>
                            <td class="<?= extension_loaded('zlib') ? 'OK' : 'FAILED'; ?>"><?= extension_loaded('zlib') ? 'OK' : 'FAILED'; ?>
                            <td>Optional
                            <td>Zlib extension for PHP
                            <td><?= extension_loaded('zlib') ? 'Available' : 'Not installed'; ?>
                </table>

                <p><strong>Tip:</strong> Many PHP extension just need to be activated in your php.ini file.</p>

                <p><button class="prev">Previous</button><button class="next"<?= !$isOK ? ' disabled' : ''?>>Next</button></p>
            </div>
        </section>
    </div>
    <div id="page-4" class="page">
        <section>
            <h1>Database</h1>
            <div>
                <p>Please create a database this WebApp can use and configure every field.</p>

                <form>
                    <ul>
                        <li><label>Address</label>
                        <li><input type="text" value="127.0.0.1" required>
                        <li><label>Type</label>
                        <li><select>
                                <option value="mysql" selected>MySQL
                                <option value="postgresql">PostgreSQL
                                <option value="mssql">MSSQL
                            </select>
                        <li><label>Port</label>
                        <li><input type="number" value="3306" required>
                        <li><label>Prefix</label>
                        <li><input type="text" value="oms_" required>
                        <li><label>Database</label>
                        <li><input type="text" value="oms" required>
                    </ul>
                </form>

                <h2>Users</h2>

                <p>This WebApp uses different database users for different tasks. This way permissions can be 
                managed in a batter way which also helps to improve the security. You can use always the same 
                user and give that user the necessary permissions, this however is not advised. Please make 
                sure every user only has the necessary permissions assigned.</p>

                <h3>Schema</h3>

                <p>The schema user is responsible for modifying the database structure and is only used during 
                the installation and potentially during updates if the database needs to be modified.</p>

                <ul>
                    <li><label>User</label>
                    <li><input type="text" value="" required>
                    <li><label>Password</label>
                    <li><input type="password" value="" required>
                </ul>

                <h3>Create</h3>

                <p>The create user is only used by the API for creating new database entries.</p>

                <ul>
                    <li><label>User</label>
                    <li><input type="text" value="" required>
                    <li><label>Password</label>
                    <li><input type="password" value="" required>
                </ul>

                <h3>Select</h3>

                <p>The select user is used by every part of the WebApp to read database entries.</p>

                <ul>
                    <li><label>User</label>
                    <li><input type="text" value="" required>
                    <li><label>Password</label>
                    <li><input type="password" value="" required>
                </ul>

                <h3>Update</h3>

                <p>The update user is only used by the API for updating existing database entries.</p>
                
                <ul>
                    <li><label>User</label>
                    <li><input type="text" value="" required>
                    <li><label>Password</label>
                    <li><input type="password" value="" required>
                </ul>

                <h3>Delete</h3>

                <p>The delete user is only used by the API for deleting existing database entries. </p>

                <ul>
                    <li><label>User</label>
                    <li><input type="text" value="" required>
                    <li><label>Password</label>
                    <li><input type="password" value="" required>
                </ul>

                <p><button class="prev">Previous</button><button class="next">Next</button></p>
            </div>
        </section>
    </div>
    <div id="page-5" class="page">
        <section>
            <h1>Configuration</h1>
            <div>
                <p>The following configuration options are general WebApp settings.</p>

                <form>
                    <ul>
                        <li><label>Organization Name</label>
                        <li><input type="text" value="Orange-Management" required>
                        <li><label>Admin Login</label>
                        <li><input type="text" value="admin" required>
                        <li><label>Admin Password</label>
                        <li><input type="password" value="" required>
                        <li><label>Admin Email</label>
                        <li><input type="email" value="" required>
                        <li><label>Logfile Path</label>
                        <li><input type="text" value="<?= realpath(__DIR__ . '/../Logs'); ?>" required>
                        <li><label>Web Subdirectory</label>
                        <li><input type="text" value="/" required>
                        <li><label>Default Language</label>
                        <li><select>
                                <option value="en" selected>English
                            </select>
                    </ul>
                </form>
                <p><button class="prev">Previous</button><button class="next">Install</button></p>
            </div>
        </section>
    </div>
    <div id="page-6" class="page">
        <section>
            <h1>Installation</h1>
            <div>
                <p>Please wait until the installation finishes. You will be redirected to the backend 
                afterwards.</p>
                </div>
        </section>
    </div>
</main>
<script>
    const nextButtons = Array.prototype.slice.call(document.getElementsByClassName('next')),
        prevButtons = Array.prototype.slice.call(document.getElementsByClassName('prev')),
        nextButtonsLength = nextButtons.length;
        prevButtonsLength = prevButtons.length;

    for(let i = 0; i < nextButtonsLength; i++) {
        nextButtons[i].addEventListener('click', function() {
            let index = nextButtons.indexOf(this);

            document.getElementsByTagName('main')[0].setAttribute(
                'style', 
                'margin-left: ' + ((index + 1) * -100) + '%;'
            );
        });
    }

    for(let i = 0; i < prevButtonsLength; i++) {
        prevButtons[i].addEventListener('click', function() {
            let index = prevButtons.indexOf(this);

            document.getElementsByTagName('main')[0].setAttribute(
                'style', 
                'margin-left: ' + (index * -100) + '%;'
            );
        });
    }
</script>