<?

$db = LogUtils::openDatabase ();

/*
 * user_log
 */

LogUtils::executeQuery($db, "drop table user_log");

LogUtils::executeQuery($db, "
CREATE TABLE user_log (
    user_log_id integer primary key,
    visit_date  date,
    visit_time  time,
    site_id     int,
    demo_id     int,
    login_id    string,
    session     string,
    firstname   string,
    lastname    string,
    address1    string,
    address2    string,
    city        string,
    state       string,
    zip         string
)");

LogUtils::executeQuery($db, "create index index_user_log_site  on user_log (site_id)");
LogUtils::executeQuery($db, "create index index_user_log_demo  on user_log (demo_id)");
LogUtils::executeQuery($db, "create index index_user_log_login on user_log (login_id);");
LogUtils::executeQuery($db, "create index index_user_log_date  on user_log (visit_date);");

/*
 * user_demographics
 */

LogUtils::executeQuery($db, "drop table user_demographics");

LogUtils::executeQuery($db, "
CREATE TABLE user_demographics (
    user_log_id integer,
    seq         int,
    answer      string,
    primary key (user_log_id, seq)
)");

/*
 * demographic_description
 */

LogUtils::executeQuery($db, "drop table demographic_description");

LogUtils::executeQuery($db, "
CREATE TABLE demographic_description (
    demo_id    int,
    seq        int,
    question   string,
    primary key (demo_id, seq)
)");

LogUtils::executeQuery($db, "create index index_demographic_description_demo_pk on demographic_description (demo_id, seq)");

LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (1, 0, 'Comic books purchased in month period.' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (1, 1, 'Titles' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (1, 2, 'Dollar amount' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (1, 3, 'Credit amount' )");

LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (2, 0, 'Age of first use of screwdriver.' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (2, 1, 'Average number of months between screwdriver purchases.' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (2, 2, 'Total number of screwdrivers purchased during lifetime.' )");
LogUtils::executeQuery($db, "insert into demographic_description (demo_id, seq, question) values (2, 3, 'Number of weeks between screwdrive uses.' )");

LogUtils::closeDatabase ($db);

?>
