import java.util.Enumeration;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.PriorityQueue;

public class HelpDesk {
    int hourValue = 100;
    PriorityQueue<Ticket> ticketsQueue = new PriorityQueue();
    PriorityQueue<Ticket> ticketsQueueT = new PriorityQueue();

    public void addTicket(Ticket ticket) {
        ticketsQueue.add(ticket);
    }

    public void getPriorityTickets() {
        while (!ticketsQueue.isEmpty()) {
            for (String tag : ticketsQueue.element().listTags) {
                System.out.println(tag);
            }
            ticketsQueueT.add(ticketsQueue.element());
            ticketsQueue.poll();
        }
    }

    public int getTotal() {
        int total = 0;
        Iterator<Ticket> iterator = ticketsQueue.iterator();
        while (iterator.hasNext()) {
            total += iterator.next().hours * this.hourValue;
        }

        return total ;
    }

    public int getaverageResponse() {
        int averageResponse = 0;

        Iterator<Ticket> iterator = ticketsQueue.iterator();
        while (iterator.hasNext()) {
            averageResponse += iterator.next().hours;
        }

        return averageResponse = averageResponse / ticketsQueue.size();
    }

    public void getTicketById(int id) {
        getTicketById(ticketsQueueT, id);
    }

    private void getTicketById(PriorityQueue<Ticket> ticketsQueueT, int id) {
        if(ticketsQueueT.size() == 0) {
            System.out.println("id " + id + " not found");
            return;
        }

        if(ticketsQueueT.element().id == id) {
            for (String tag: ticketsQueueT.element().listTags
            ) {
                System.out.println(tag);
            }
            return;
        }

        ticketsQueueT.poll();

        getTicketById(ticketsQueueT, id);
    }

    public String getMostCommonTicket() {
        Hashtable<String, Integer> hashTickets = new Hashtable<String, Integer>();

        for(Ticket ticket : ticketsQueue) {
            for(String tag : ticket.listTags) {
                int count = 1;
                if (hashTickets.containsKey(tag)) {
                    count++;
                }
                hashTickets.put(tag, count);
            }
        }

        int mostCommonTicketCount = 0;
        String mostCommonTicket = "";

        Enumeration<String> enumeration = hashTickets.keys();
        while (enumeration.hasMoreElements()) {
            String key = enumeration.nextElement();
            if (hashTickets.get(key) > mostCommonTicketCount) {
                mostCommonTicketCount = hashTickets.get(key);
                mostCommonTicket = key;
            }
        }

        return mostCommonTicket;
    }
}
