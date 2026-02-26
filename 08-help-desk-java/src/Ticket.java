import java.util.ArrayList;

public class Ticket implements Comparable<Ticket> {
    int id;
    String customerName;
    int hours;
    ArrayList<String> listTags = new ArrayList<>();

    int priority;

    Ticket(int id, String customerName, int priority, int hours) {
        this.id = id;
        this.customerName = customerName;
        this.priority = priority;
        this.hours = hours;
    }

    @Override
    public int compareTo(Ticket ticket) {
        if(this.priority > ticket.priority) {
            return 1;
        } else if (this.priority < ticket.priority) {
            return -1;
        } else {
            return 0;
        }
    }
}
