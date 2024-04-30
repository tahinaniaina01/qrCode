#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
  FILE *f = popen("ls ./ | sort -n | grep '.jpg'","r");
  char line[200];
  int i = 72;
char filename[200];
  while (fgets(line, 200, f)) {
    
     line[strcspn(line, "\n")] = '\0';
     for(int j=0; j<strlen(line); j++){
      filename[j] = line[j];
    }

    if (strstr(filename, "_11zon.jpg") != NULL) {
      int a = atoi(strtok(filename, "_"));
      char new_filename[200];
      sprintf(new_filename, "%d.jpg", a);

      char cmd[1000];
      sprintf(cmd, "mv ./%s ./%s", line, new_filename);

      printf("%s et %s\n",line, cmd);

      system(cmd);
    } 
  }

  return 0;
}
