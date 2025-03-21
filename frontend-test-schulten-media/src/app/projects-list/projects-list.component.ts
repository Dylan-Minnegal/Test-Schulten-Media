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
  comments: { [taskId: number]: string } = {};  


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
  markAsCompleted(projectId: number, taskId: number) {
    this.projectsService.completeTask(projectId, taskId).subscribe(
      (updatedTask) => {
        const project = this.projects.find(p => p.id === projectId);
        const task = project?.tasks.find((t: any) => t.id === taskId);
        if (task) task.completed = true;
        console.log('Task marked as completed:', updatedTask);
      },
      (error) => {
        console.error('Error updating task:', error);
      }
    );
  }

  leaveComment(projectId: number, taskId: number) {
    if (this.comments[taskId]?.trim()) {
      const token = localStorage.getItem('token');
      
      const user = JSON.parse(localStorage.getItem('user') || '{}');
      const userId = user?.id;
      
      if (userId) {
        this.projectsService.leaveComment(projectId, taskId, this.comments[taskId], userId).subscribe(
          (success) => {
            console.log('Comment added successfully');
            this.comments[taskId] = ''; 
          },
          (error) => {
            console.error('Error adding comment:', error);
          }
        );
      } else {
        console.error('User ID not found.');
      }
    } else {
      alert('Please enter a comment');
    }
  }
  
  


}