import java.sql.*;

public class ConnectorClass
{
    public static void main( String[] args )
    {
        final String DBNAME = "melisa_taspinar";
        final String URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/" + DBNAME;
        final String USERNAME = "melisa.taspinar";
        final String PASSWORD = "mBYLLLVW";
        Connection connection = null;

        // Finding the MySQL JDBC Driver
        try
        {
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch ( ClassNotFoundException e )
        {
            System.out.println( "WARNING: Could not find MySQL JDBC Driver." );
        }

        // Connecting
        try
        {
            connection = DriverManager.getConnection( URL, USERNAME, PASSWORD );
        }
        catch ( SQLException e )
        {
            System.out.println("WARNING: Connection unsuccessful.");
        }

        // Warning the user if connection is null
        if ( connection == null )
        {
            System.out.println( "WARNING: Connection was unsuccessful." );
        }

        Statement statement;

        try
        {
            statement = connection.createStatement();

            // Dropping the pre-existing tables
            statement.executeUpdate("DROP TABLE IF EXISTS apply;");
            statement.executeUpdate("DROP TABLE IF EXISTS student;");
            statement.executeUpdate("DROP TABLE IF EXISTS company;");
            System.out.println( "All pre-existing tables, if any, have been dropped." );

            // Creating tables
            statement.executeUpdate("CREATE TABLE student (sid CHAR(12),sname VARCHAR(50),bdate DATE,address VARCHAR(50), " +
                    "scity VARCHAR(20),year CHAR(20),gpa FLOAT,nationality VARCHAR(20),PRIMARY KEY(sid)) ENGINE=innodb;" );
            statement.executeUpdate("CREATE TABLE company (cid CHAR(8),cname VARCHAR(20),quota INT,PRIMARY KEY(cid)) ENGINE=innodb;" );
            statement.executeUpdate("CREATE TABLE apply (sid CHAR(12),cid CHAR(8),PRIMARY KEY(sid, cid)," +
                    "FOREIGN KEY(sid) REFERENCES student(sid), FOREIGN KEY(cid) REFERENCES company(cid)) ENGINE=innodb;" );
            System.out.println( "Tables have been created." );

            // Populating tables
            statement.executeUpdate("INSERT INTO student VALUES (21000001, 'John', '1999-05-14', 'Windy', 'Chicago', 'senior', 2.33, 'US'), " +
                    "(21000002, 'Ali', '2001-09-30', 'Nisantasi', 'Istanbul', 'junior', 3.26, 'TC'), " +
                    "(21000003, 'Veli', '2003-02-25', 'Nisantasi', 'Istanbul', 'freshman', 2.41, 'TC'), " +
                    "(21000004, 'Ayse', '2003-01-15', 'Tunali', 'Ankara', 'freshman', 2.55, 'TC');");
            statement.executeUpdate("INSERT INTO company VALUES ('C101', 'microsoft', 2), ('C102', 'merkez bankasi', 5), " +
                    "('C103', 'tai', 3), ('C104', 'tubitak', 5), ('C105', 'aselsan', 3), ('C106', 'havelsan', 4), ('C107', 'milsoft', 2);");
            statement.executeUpdate("INSERT INTO apply VALUES (21000001, 'C101'), (21000001, 'C102'), (21000001, 'C103'), " +
                    "(21000002, 'C101'), (21000002, 'C105'), (21000003, 'C104'), (21000003, 'C105'), (21000004, 'C107');");
            System.out.println( "Tables have been populated." );

            // Printing the student table
            System.out.println("\n ******************************************** STUDENT TABLE ********************************************");
            System.out.printf("%10s   %10s   %10s   %10s   %10s   %10s   %10s   %10s%n", "sid", "name", "bdate", "address", "scity", "year", "gpa", "nationality" );
            ResultSet students = statement.executeQuery("SELECT * FROM student");
            while ( students.next() )
            {
                System.out.printf( "%10s   %10s   %10s   %10s   %10s   %10s   %10s   %10s%n", students.getString("sid"), students.getString("sname"),
                        students.getString("bdate"), students.getString("address"), students.getString("scity"),
                        students.getString("year"), students.getString("gpa"), students.getString("nationality"));
            }
        }
        catch ( SQLException e )
        {
            System.out.println( "WARNING: SQLException\n" + e.getMessage() );
        }
    }
}