import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.Arrays;
import java.util.PriorityQueue;

public class Program {
    public static void main(String[] args) throws IOException {
        String[] dataTicket;

        HelpDesk helpDesk = new HelpDesk();

        BufferedReader bf = new BufferedReader(new FileReader("tickets.txt"));

        int qtyTickets = Integer.parseInt(bf.readLine());

        for (int i = 0; i < qtyTickets; i++) {
            dataTicket = bf.readLine().split(",");

            Ticket ticket = new Ticket(Integer.parseInt(dataTicket[0]), dataTicket[1], Integer.parseInt(dataTicket[2]), Integer.parseInt(dataTicket[3]) );

            ticket.listTags.addAll(Arrays.asList(dataTicket).subList(4, dataTicket.length));

            helpDesk.addTicket(ticket);
        }

        System.out.println(helpDesk.getTotal());
        System.out.println(helpDesk.getaverageResponse());
        System.out.println(helpDesk.getMostCommonTicket());
        helpDesk.getPriorityTickets();
        helpDesk.getTicketById(3);
    }
}
