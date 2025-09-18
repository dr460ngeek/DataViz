# The dataviz repository

#### In order to use it, clone it through git.
PLEASE DO NOT SHARE THIS LINK PUBLICLY AS THIS REPO IS PRIVATE AND BELONGS TO SCHOOL OF COMPUTER SCIENCE ONLY.

```bash  
    git clone https://github.com/dr460ngeek/dataviz.git
```

Here’s how the structure fits together:

* **Main modules:**

  * `admin/index.php` → Admin panel
  * `auctioner/index.php` → Auctioner panel
  * `user/index.php` → User (bidders/players) panel
  * `view/index.php` → Viewer’s panel (spectators)
  * `leaderboard/leaderboard.php` → Leaderboard page

* **Database:**

  * `DB/data_viz.sql` → Database dump you need to import into MySQL.
  * `DB/config.php` → Likely contains DB connection details (`host`, `user`, `password`, `database`).

* **Assets:**

  * `images/` → Logos, player images, etc.
  * `style/` and `script/` folders inside each module for UI.

---

### Steps to run it locally

1. **Install XAMPP / WAMP / MAMP (Windows/Linux/Mac)**

   * This gives you Apache (web server), PHP, and MySQL.

2. **Place the project**

   * Move the `DataViz` folder into:

     * Windows: `C:\xampp\htdocs\`
     * Linux (XAMPP): `/opt/lampp/htdocs/`
     * Mac/OSx (XAMPP): `/Applications/lampp/htdocs/`
     * Native Apache: `/var/www/html/`

3. **Start services**

   * Start **Apache** and **MySQL** from the XAMPP/WAMP control panel.
   
4. **Import the database**

   * Open `http://localhost/phpmyadmin`
   * Create a database, e.g., `data_viz`
   * Import `DB/data_viz.sql` into it.

5. **Access the website**

   * For Admin → `http://localhost/DataViz/admin/`
   * For Auctioner → `http://localhost/DataViz/auctioner/`
   * For User → `http://localhost/DataViz/user/`
   * For Viewer → `http://localhost/DataViz/view/`
   * For Leaderboard → `http://localhost/DataViz/leaderboard/`

---