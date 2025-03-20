import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { ProjectsService } from '../projects.service';
import { CdkDragDrop, moveItemInArray } from '@angular/cdk/drag-drop';


@Component({
  selector: 'app-projects-list',
  templateUrl: './projects-list.component.html',
  styleUrls: ['./projects-list.component.css'],
})
export class ProjectsListComponent implements OnInit {
  projects: any[] = [];
  user: any;


  constructor(private projectsService: ProjectsService) { }

  ngOnInit() {
    this.projectsService.getProjects().subscribe(data => this.projects = data);
    const user = localStorage.getItem('user');
    if (user) {
      this.user = JSON.parse(user);
    }
  }
  get isLoggedIn(): boolean {
    return !!localStorage.getItem('user');
  }
  logout(): void {
    localStorage.removeItem('user');
    localStorage.removeItem('token');
  }
  drop(event: CdkDragDrop<any[]>, project: any): void {
    moveItemInArray(project.tasks, event.previousIndex, event.currentIndex);
  }
}